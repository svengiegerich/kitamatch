# KitaMatch - Database Manual

## EER Diagram
![alt text](db_eer_diagram.png ’EER Diagram’)

## Program
Program class handles public and private programs.
### Codes
#### p_kind
* 1: Public
* 2: Private
#### Status
* 10: not valid
* 11: created, but not proofed; no participation
* 12: valid; participates
* 13: did not send offers for at least seven days; no participation

## Applicant
Applicant class handles the applicants and their information, here children.
### Codes
#### Status
* 20: not valid (either no preferences or valid documents)
* 21: created, but not proofed; no participation
* 22: valid; participates
* 25: priority
* 26: finished matching

## Matching
Matching class mainly handles the API calls.
### Codes
#### Status
* 30: no match
* 31: current match
* 32: final match
* 33: historical match 

## Preferences
Preference class maintains preferences in two-directions, from applicant to program and from program to applicant.
### Codes
#### pr_kind
* 1: applicant to program
* 2: coordinated program to applicant
* 3: uncoordinated program to applicant
#### Status Codes
* -1: historic
* 0: not valid
* 1: valid

## Guardians
Guardians maintain the social master data required for the coordination and hols 
### Codes
#### Status
* 50: not valid (either no preferences or valid documents)
* 51: created, but not proofed; no participation
* 52: valid

## Criteria
### Codes
#### parental_status
* 820: Eine/Ein Alleinerziehende/r beschäftig
* 821: Beide Erziehungsberechtigte beschäftigt
* 822: Ein Erziehungsberechtigter beschäftigt
* 823: Alleinerziehend ohne Beschäftigung
* 824: Sonstig
#### volume_of_employment
* 830: Ganztags (ab 28 h/Woche)
* 831: Halbtags (ab 16-27 h/Woche)
* 832: Geringfügig (ab 8-15 h/Woche)
* 833: Ohne Beschäftigung
#### siblings
* 840: Kein Geschwisterkind
* 841: Geschwisterkind

## User
### Codes
#### account_type
* 1: Guardian
* 2: public Program 
* 3: private Program
* 4: Provider
* 5: Admin