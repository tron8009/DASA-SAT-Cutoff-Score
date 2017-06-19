# DASA-SAT-Cutoff-Score
To analyse the DASA SAT Cutoff Score. Database used from the official DASA website.

How to create the Database?
**CSV Files are enclosed in the CSV folder.**
1. 
CREATE DATABASE DASA;

2. 
CREATE TABLE instituteTable(
 iNo INT,
 instituteName VARCHAR(255) NOT NULL,
 score_2015 INT,
 score_2016 INT,
 PRIMARY KEY(iNo)
);
  
3.
Import the CSV file(instituteTable.csv).

4.
CREATE TABLE courseNameTable(
 cNo INT NOT NULL,
 cName varchar(255) NOT NULL,
 PRIMARY KEY(cNo)
);

5.
Import the CSV file(courseNameTable.csv).

6.
CREATE TABLE courseScoreTable(
  iNo INT NOT NULL,
  cNo INT NOT NULL,
  score_2015 INT,
  score_2016 INT,
  FOREIGN KEY(iNo) REFERENCES instituteTable(iNo),
  FOREIGN KEY(cNo) REFERENCES courseNametable(cNo)
);

7.
Import the CSV file(courseScoreTable).

******************************************************************************************************
******************************************************************************************************

Queries/Searches:
******************************************************************************************************

Case 0:

Input Name: [ Institute Name | Course Name | Score ]
Output:     [ Eligibility ]

SELECT cs.score_2016 
FROM courseScoreTable cs, instituteTable it 
WHERE (it.iNo = $instituteNo) AND (cs.cNo = $courseNo) AND (it.iNo = cs.iNo);


Case 1:

Input  [Institute Name | Course Name ]
Output [Course Name | Score ]

SELECT cn.cName, cs.score_2015, cs.score_2016 
FROM courseNametable cn, courseScoretable cs, instituteTable it 
WHERE (it.iNo = $instituteNo) AND (cs.cNo = $courseNo) AND (it.iNo = cs.iNo) AND (cs.cNo = cn.cNo);


Case 2:

Input  [Course Name | Score ]
Output [Institute Name | Score ]

SELECT it.instituteName, cs.score_2015, cs.score_2016  
FROM courseScoretable cs, instituteTable it 
WHERE (cs.iNo = it.iNo) AND (cs.cNo = $courseNo) AND (cs.score_2016 < $score) AND (cs.score_2016 > 0) ORDER BY cs.score_2016;


Case 3:

Input  [Institute Name | Score ]
Output [Course Name | Score ]

SELECT cn.cName, cs.score_2015, cs.score_2016  
FROM courseNameTable cn, courseScoreTable cs, instituteTable it 
WHERE (it.iNo = cs.iNo) AND (cs.cNo = cn.cNo) AND (it.iNo = $instituteNo) AND (cs.score_2016 < $score) AND (cs.score_2016 > 0);


Case 4:

Input  [Institute Name]
Output [Course Name | Score ]

SELECT cn.cName, cs.score_2015, cs.score_2016 
FROM courseNameTable cn, courseScoreTable cs, instituteTable it 
WHERE (it.iNo = $instituteNo) AND (it.iNo = cs.iNo) AND (cn.cNo = cs.CNo);


Case 5:

Input  [Course Name]
Output [Institute Name | Score ]

SELECT it.instituteName, cs.score_2015, cs.score_2016  
FROM courseNameTable cn, courseScoreTable cs, instituteTable it 
WHERE (it.iNo = cs.iNo) AND (cs.cNo = cn.cNo) AND (cn.cNo = $courseNo) AND (cs.score_2016 > 0)
ORDER BY cs.score_2016;


Case 6:

Input  [Score]
Output [Institute Name | Course Name | Score ]

SELECT it.instituteName, cn.cName, cs.score_2015, cs.score_2016  
FROM courseNameTable cn, courseScoreTable cs, instituteTable it 
WHERE (it.iNo = cs.iNo) AND (cs.cNo = cn.cNo) AND (cs.score_2016 < $score) AND (cs.score_2016 > 0)
;



