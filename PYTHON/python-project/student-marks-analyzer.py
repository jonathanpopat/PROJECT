# student-marks-analyzer



# ---------------------------------------------------
# Task 1: Student Marks Analyzer
# ---------------------------------------------------
# This program stores marks of students in 3 subjects,
# then finds:
#   1. Average marks of each student
#   2. The topper (student with highest total marks)
#   3. Subject-wise average marks
# ---------------------------------------------------

# Step 1: Store data using a dictionary
# Key = student name, Value = list of marks in 3 subjects
marks = {
    "Alice": [75, 80, 90],
    "Bob": [60, 70, 65],
    "Charlie": [90, 95, 88]
}

# Names of the 3 subjects (in the same order as the marks list)
subjects = ["Math", "Science", "English"]

# ---------------------------------------------------
# Step 2: Calculate and display average marks of each student
# ---------------------------------------------------
print("---- Student-wise Average Marks ----")

for name in marks:
    total = sum(marks[name])          # add up all 3 marks
    average = total / 3               # divide by number of subjects
    print(name + " -> Average:", round(average, 1))

print()  # blank line for spacing

# ---------------------------------------------------
# Step 3: Find the topper (student with highest total marks)
# ---------------------------------------------------
max_total = 0
topper = ""

for name in marks:
    total = sum(marks[name])
    if total > max_total:
        max_total = total
        topper = name

print("Topper:", topper, "with", max_total, "marks")
print()

# ---------------------------------------------------
# Step 4: Subject-wise average marks
# ---------------------------------------------------
print("---- Subject-wise Averages ----")

number_of_students = len(marks)

# Loop over each subject index: 0 = Math, 1 = Science, 2 = English
for subject_index in range(3):
    subject_total = 0

    # Add up marks of that subject for all students
    for name in marks:
        subject_total = subject_total + marks[name][subject_index]

    subject_average = subject_total / number_of_students
    print(subjects[subject_index] + ":", round(subject_average, 1))