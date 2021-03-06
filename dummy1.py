#!/usr/bin/env python3

import faker
import random

fake = faker.Faker()
#a list that holds all the used keys 
usedKeys = []


dateEv = []

#number of projects, it is here because we need it before executive
DUMMY_DATA_NUMBER_3 = 100


### Organization

class Organiz:
    def __init__(self, organiz_id):
        self.organiz_id = organiz_id 
        self.researchers = []

DUMMY_DATA_NUMBER_2 = 30;
TABLE_NAME_2 = "organization";
TABLE_COLUMNS_2 = ["organization_id", "name_org", "abbreviation", "city", "street", "postal_code", "org_type", "funds_company", "budget_uni_ministry", "budget_rc1", "budget_rc2" ]
content = "";

organisation_type = ["University", "Research Center", "Company"]
cityN = ["Athens", "Thessaloniki", "Larisa", "Patra", "Heraklion", "Trikala", "Chania", "Ioannina", "Rhode Island","Chalkida"] 
street_names = ["Agathiou", "Eleftheriou Venizelou", "Samothrakis", "Evripidou", "Kantonia", "Androutsou", "Mpotsari", "Ippokratous", "Kifisou", "Klepsydra", "Nikopoleos", "Orionos"]

org_IDs = random.sample(range(10000,99999),DUMMY_DATA_NUMBER_2)
organizationsL = []



for i in range(len(org_IDs)):
    usedKeys.append(org_IDs[i])

for _ in range(DUMMY_DATA_NUMBER_2):
    orgID = org_IDs[_]
    fundscompany = 0
    budgetuniministry = 0
    budgetRC1 = 0
    budgetRC2 = 0
    intNum = random.randint(100,999)
    organisationtype = random.choice(organisation_type)
    name = organisationtype +  str(intNum)
    if(organisationtype == "University"):
        abbreviation = "UN" + str(intNum)
    elif(organisationtype == "Company"):
        abbreviation = "C" + str(intNum)
    else:
        abbreviation = "RC" + str(intNum)
    city = random.choice(cityN)
    address = random.randint(1,150)
    street = random.choice(street_names) + str(address)
    postalcode = random.randint(10000,99999)
    if(organisationtype == "Company"):
        fundscompany = random.randint(0,100000000)
    elif(organisationtype == "University"): 
        budgetuniministry = random.randint(0,100000000)
    else:
        budgetRC1 = random.randint(0,100000000)
        budgetRC2 = random.randint(0, 100000000)
    content += f'INSERT INTO {TABLE_NAME_2} ({",".join(TABLE_COLUMNS_2)}) VALUES ("{orgID}", "{name}", "{abbreviation}", "{city}", "{street}", "{postalcode}", "{organisationtype}", "{fundscompany}", "{budgetuniministry}", "{budgetRC1}", "{budgetRC2}");\n'
    org1 = Organiz(orgID)
    organizationsL.append(org1)

with open(f"insert_data.sql", 'w') as f:
    f.write("-- organization \n")
    f.write(content)
    f.write("\n")




###Researcher



DUMMY_DATA_NUMBER_1 = 200;
TABLE_NAME_1 = "researcher";
TABLE_COLUMNS_1 = ["researcher_id","first_name", "last_name", "birthdate", "gender","organization_id", "datework"]
content = "";

research_IDs = []



    

for i in range(DUMMY_DATA_NUMBER_1):
    res = random.choice([i for i in range(10000,99999) if i not in usedKeys])
    usedKeys.append(res)
    research_IDs.append(res)

genders = ["Male", "Female", "Non-Binary"]


#next bit is in order to make every org has at least one researcher
for i in range(len(org_IDs)):
    researcher_id = research_IDs[i]
    firstName = fake.first_name()
    lastName = fake.last_name()
    day = random.randint(1,28)
    month = random.randint(1,12)
    year = random.randint(1965, 2000)
    birthday = str(year) + "-" + str(month) + "-" + str(day)
    gender = random.choice(genders)
    day1 = random.randint(1,28)
    month1 = random.randint(1,12)
    year1 = random.randint(2010,2022)
    date = str(year1) + "-" + str(month1) + "-" + str(day1)
    organization_id = org_IDs[i-1]
    organizationsL[i-1].researchers.append(researcher_id)
    content += f'INSERT INTO {TABLE_NAME_1} ({",".join(TABLE_COLUMNS_1)}) VALUES ("{researcher_id}", "{firstName}", "{lastName}", "{birthday}", "{gender}", "{organization_id}", "{date}");\n'
    
for _ in range(DUMMY_DATA_NUMBER_1 - len(org_IDs)):
    researcher_id = research_IDs[len(org_IDs)+_]
    firstName = fake.first_name()
    lastName = fake.last_name()
    day = random.randint(1,28)
    month = random.randint(1,12)
    year = random.randint(1950, 2000)
    birthday = str(year) + "-" + str(month) + "-" + str(day)
    gender = random.choice(genders)
    day1 = random.randint(1,28)
    month1 = random.randint(1,12)
    year1 = random.randint(2010,2022)
    date = str(year1) + "-" + str(month1) + "-" + str(day1)
    num = random.randint(1,len(org_IDs)-1)
    organization_id = org_IDs[num]
    organizationsL[num].researchers.append(researcher_id)
    content += f'INSERT INTO {TABLE_NAME_1} ({",".join(TABLE_COLUMNS_1)}) VALUES ("{researcher_id}", "{firstName}", "{lastName}", "{birthday}", "{gender}", "{organization_id}", "{date}");\n'
with open(f"insert_data.sql", 'a') as f:
    f.write("-- researcher \n")
    f.write(content)
    f.write("\n")




###Program
DUMMY_DATA_NUMBER_4 = 40;
TABLE_NAME_4 = "program";
TABLE_COLUMNS_4 = ["program_id","name_pr", "management"]
content = "";


nums1 = random.sample(range(100,999),DUMMY_DATA_NUMBER_4)

progr_IDs = []

for i in range(DUMMY_DATA_NUMBER_4):
    progr = random.choice([i for i in range(10000,99999) if i not in usedKeys])
    usedKeys.append(progr)
    progr_IDs.append(progr)

for _ in range(DUMMY_DATA_NUMBER_4):
    program_id=progr_IDs[_]
    name = "program" + str(nums1[_])
    management = fake.name()
    content += f'INSERT INTO {TABLE_NAME_4} ({",".join(TABLE_COLUMNS_4)}) VALUES ("{program_id}","{name}","{management}");\n'

with open(f"insert_data.sql", 'a') as f:
    f.write("-- program \n")
    f.write(content)
    f.write("\n")


DUMMY_DATA_NUMBER_5 = 10;
TABLE_NAME_5 = "scientific_field";
TABLE_COLUMNS_5 = ["scfield_id", "name_scfield"]
content = "";

scifi_IDs = []

for i in range(DUMMY_DATA_NUMBER_5):
    scifi = random.choice([i for i in range(10000,99999) if i not in usedKeys])
    usedKeys.append(scifi)
    scifi_IDs.append(scifi)
    
sci_fi = ["Mathematics", "Computer Science", "Physics", "Biology", "Chemistry", "Geology", "Law", "Natural Sciences", "Economics", "Irrelevant"]



#Scientific Field
for _ in range(DUMMY_DATA_NUMBER_5):
    scfield_id = scifi_IDs[_]
    name = sci_fi[_]
    content += f'INSERT INTO {TABLE_NAME_5} ({",".join(TABLE_COLUMNS_5)}) VALUES ("{scfield_id}","{name}");\n'

with open(f"insert_data.sql", 'a') as f:
    f.write("-- scientific_field \n")
    f.write(content)
    f.write("\n")


#Evaluation 
DUMMY_DATA_NUMBER_6 = DUMMY_DATA_NUMBER_3;
TABLE_NAME_6 = "evaluation";
TABLE_COLUMNS_6 = ["evaluation_id","grade", "date_eval"]
content = "";

eval_IDs = []

for i in range(DUMMY_DATA_NUMBER_6):
    evaluat = random.choice([i for i in range(10000,99999) if i not in usedKeys])
    usedKeys.append(evaluat)
    eval_IDs.append(evaluat)

for _ in range(DUMMY_DATA_NUMBER_6):
    evaluation_id=eval_IDs[_]
    grade = random.randint(5,10)
    day = random.randint(1,28)
    month = random.randint(1,12)
    year = random.randint(2013, 2014)
    dateEv = str(year) + "-" + str(month) + "-" + str(day)
    content += f'INSERT INTO {TABLE_NAME_6} ({",".join(TABLE_COLUMNS_6)}) VALUES ("{evaluation_id}","{grade}", "{dateEv}");\n'

with open(f"insert_data.sql", 'a') as f:
    f.write("-- evaluation \n")
    f.write(content)
    f.write("\n")


###Executive
DUMMY_DATA_NUMBER_7 = DUMMY_DATA_NUMBER_3;
TABLE_NAME_7 = "executive";
TABLE_COLUMNS_7 = ["executive_id","name_ex"]
content = "";

exe_IDs = []

for i in range(DUMMY_DATA_NUMBER_7):
    execut = random.choice([i for i in range(10000,99999) if i not in usedKeys])
    usedKeys.append(execut)
    exe_IDs.append(execut)
    
for _ in range(DUMMY_DATA_NUMBER_7):
    executive_id=exe_IDs[_]
    nameEx = fake.name()
    content += f'INSERT INTO {TABLE_NAME_7} ({",".join(TABLE_COLUMNS_7)}) VALUES ("{executive_id}","{nameEx}");\n'

with open(f"insert_data.sql", 'a') as f:
    f.write("-- executive \n")
    f.write(content)
    f.write("\n")


class Proj:
    def __init__(self, project_id):
        self.project_id = project_id 
        self.researchers = []

projList = []

###Project
TABLE_NAME_3 = "project";
TABLE_COLUMNS_3 = ["project_id","title", "start_date", "end_date", "abstract", "funds", "evaluator_id", "accountable_id", "program_id", "executive_id", "organization_id", "evaluation_id"]
content = "";

nums = random.sample(range(100,999),DUMMY_DATA_NUMBER_3)


proj_IDs = []
proj_SDday = []
proj_SDmonth = []
proj_SDyear = []
proj_org = []

for i in range(DUMMY_DATA_NUMBER_3):
    proj = random.choice([i for i in range(10000,99999) if i not in usedKeys])
    usedKeys.append(proj)
    proj_IDs.append(proj)

print(proj_IDs)

for i in range(DUMMY_DATA_NUMBER_3):
    project_id = proj_IDs[i]
    title = "project" + str(nums[i])
    day = random.randint(1,28)
    proj_SDday.append(day)
    month = random.randint(2,12)
    proj_SDmonth.append(month)
    year = random.randint(2020, 2022)
    proj_SDyear.append(year)
    startdate = str(year) + "-" + str(month) + "-" + str(day)
    day1 = random.randint(1,28)
    month1 = random.randint(1,12)
    year1 = random.randint(year+2,year+3)
    enddate = str(year1) + "-" + str(month1) + "-" + str(day1)
    abstract = fake.paragraph(nb_sentences=2)
    funding = random.randint(100000, 1000000)
    evaluator_id = random.choice(research_IDs)
    accountable_id = random.choice(research_IDs)
    program_id = random.choice(progr_IDs)
    executive_id= random.choice(exe_IDs)
    num4 = random.randint(1,len(org_IDs)-1)
    organization_id = org_IDs[num4]
    proj_org.append(num4)
    evaluation_id = random.choice(eval_IDs)
    content += f'INSERT INTO {TABLE_NAME_3} ({",".join(TABLE_COLUMNS_3)}) VALUES ("{project_id}","{title}", "{startdate}", "{enddate}", "{abstract}", "{funding}", "{evaluator_id}", "{accountable_id}", "{program_id}", "{executive_id}", "{organization_id}", "{evaluation_id}");\n'
    proj = Proj(project_id)
    proj.researchers = organizationsL[num4].researchers
    projList.append(proj)
    
with open(f"insert_data.sql", 'a') as f:
    f.write("-- project \n")
    f.write(content)
    f.write("\n")


#####Deliverable
##DUMMY_DATA_NUMBER_8 = 10;
##TABLE_NAME_8 = "deliverable";
##TABLE_COLUMNS_8 = ["deliverable_id","project_id","title", "abstract", "deliverable_date"]
##content = "";
##
##nums2 = random.sample(range(100,999),DUMMY_DATA_NUMBER_8)
##
##deliv_IDs = []
##
##for i in range(DUMMY_DATA_NUMBER_8):
##    deli = random.choice([i for i in range(10000,99999) if i not in usedKeys])
##    usedKeys.append(deli)
##    deliv_IDs.append(deli)
##print(proj_IDs)
##for _ in range(DUMMY_DATA_NUMBER_8):
##    num = random.randint(1,len(proj_IDs))
##    project_id = proj_IDs[num]
##    deliverable_id=deliv_IDs[_]
##    title = "title" + str(+ nums[_])
##    abstract = fake.paragraph(nb_sentences=2)
##    day4 = (proj_SDday[num] + random.randint(1,30))%28 
##    month4 = proj_SDmonth[num] -1
##    year4 = proj_SDyear[num] + 1
##    deliveryday = str(year4) + "-" + str(month4) + "-" + str(day4)
##    content += f'INSERT INTO {TABLE_NAME_8} ({",".join(TABLE_COLUMNS_8)}) VALUES ("{deliverable_id}","{project_id}","{title}", "{abstract}", "{deliveryday}");\n'
##
##with open(f"insert_data.sql", 'a') as f:
##    f.write("-- deliverable \n")
##    f.write(content)
##    f.write("\n")

DUMMY_DATA_NUMBER_9 = DUMMY_DATA_NUMBER_2;
TABLE_NAME_9 = "phone_number";
TABLE_COLUMNS_9 = ["organization_id","phone"]
content = "";





#Phone Number
for _ in range(DUMMY_DATA_NUMBER_9):
    organization_id = random.choice(org_IDs)
    phone = random.randint(1000000000,9999999999)
    content += f'INSERT INTO {TABLE_NAME_9} ({",".join(TABLE_COLUMNS_9)}) VALUES ("{organization_id}","{phone}");\n'

with open(f"insert_data.sql", 'a') as f:
    f.write("-- phone_number \n")
    f.write(content)
    f.write("\n")

print(projList[1].researchers)

#Works On Project
DUMMY_DATA_NUMBER_10 = 300;
TABLE_NAME_10 = "works_on_project";
TABLE_COLUMNS_10 = ["project_id","researcher_id"]
content = "";

#required relationships due to total participation
for _ in range(len(proj_IDs)):
    project_id = proj_IDs[_]
    for i in range(len(projList[_].researchers)):
        researcher_id = projList[_].researchers[i]
        content += f'INSERT INTO {TABLE_NAME_10} ({",".join(TABLE_COLUMNS_10)}) VALUES ("{project_id}","{researcher_id}");\n'

##poolProj = proj_IDs
##
###extra relationships
##for _ in range(DUMMY_DATA_NUMBER_10):
##    
##    num5 = random.randint(1, len(poolProj))
##    project_id = poolProj[num5]
##    print(projList[num5].researchers)
##    if(len(projList[num5].researchers)!= 0):
##        researcher_id = random.choice(projList[num5].researchers)
##        projList[num5].researchers.remove(researcher_id)
##        content += f'INSERT INTO {TABLE_NAME_10} ({",".join(TABLE_COLUMNS_10)}) VALUES ("{project_id}","{researcher_id}");\n'
##    else:
##        poolProj.remove(poolProj[num5])
##
with open(f"insert_data.sql", 'a') as f:
    f.write("-- works_on_project \n")
    f.write(content)
    f.write("\n")
    

#Scientific Field of Project
TABLE_NAME_11 = "scientific_field_project";
TABLE_COLUMNS_11 = ["scfield_id","project_id"]
content = "";

#required relations
for _ in range(len(proj_IDs)):
    pool = [1,2,3,4,5,6,7,8,9,10]
    for i in range(random.randint(1,4)):
        project_id = proj_IDs[_]
        n = random.choice(pool)
        scfield_id = scifi_IDs[n-1]
        pool.remove(n)
        content += f'INSERT INTO {TABLE_NAME_11} ({",".join(TABLE_COLUMNS_11)}) VALUES ("{scfield_id}","{project_id}");\n'


with open(f"insert_data.sql", 'a') as f:
    f.write("-- scientific_field_project \n")
    f.write(content)
    f.write("\n")

###Deliverable
##DUMMY_DATA_NUMBER_8 = 10;
##TABLE_NAME_8 = "deliverable";
##TABLE_COLUMNS_8 = ["deliverable_id","project_id","title", "abstract", "deliverable_date"]
##content = "";
##
##nums2 = random.sample(range(100,999),DUMMY_DATA_NUMBER_8)
##
##deliv_IDs = []
##
##for i in range(DUMMY_DATA_NUMBER_8):
##    deli = random.choice([i for i in range(10000,99999) if i not in usedKeys])
##    usedKeys.append(deli)
##    deliv_IDs.append(deli)
##print(proj_IDs)
##for _ in range(DUMMY_DATA_NUMBER_8):
##    num = random.randint(1,len(proj_IDs))
##    project_id = proj_IDs[num]
##    deliverable_id=deliv_IDs[_]
##    title = "title" + str(+ nums[_])
##    abstract = fake.paragraph(nb_sentences=2)
##    day4 = (proj_SDday[num] + random.randint(1,30))%28 
##    month4 = proj_SDmonth[num] -1
##    year4 = proj_SDyear[num] + 1
##    deliveryday = str(year4) + "-" + str(month4) + "-" + str(day4)
##    content += f'INSERT INTO {TABLE_NAME_8} ({",".join(TABLE_COLUMNS_8)}) VALUES ("{deliverable_id}","{project_id}","{title}", "{abstract}", "{deliveryday}");\n'
##
##with open(f"insert_data.sql", 'a') as f:
##    f.write("-- deliverable \n")
##    f.write(content)
##    f.write("\n")
