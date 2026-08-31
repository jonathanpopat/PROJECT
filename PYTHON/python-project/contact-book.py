# ---------------------------------------------------
# Task 2: Contact Book Using Python
# ---------------------------------------------------
# This program lets the user:
#   1. Add a new contact
#   2. View all contacts
#   3. Search a contact by name
#   4. Update an existing contact
#   5. Delete a contact
#   6. Exit
# Data is stored in a simple dictionary:
#   key = contact name, value = phone number
# ---------------------------------------------------

# Dictionary to store all contacts
contacts = {}


# ---------------------------------------------------
# Function to add a new contact
# ---------------------------------------------------
def add_contact():
    name = input("Enter name: ")
    phone = input("Enter phone: ")

    # store the name in lowercase so search/update work
    # no matter how the user types the name later
    contacts[name.lower()] = phone
    print("Contact added successfully!")


# ---------------------------------------------------
# Function to view all contacts
# ---------------------------------------------------
def view_contacts():
    if len(contacts) == 0:
        print("No contacts found.")
        return

    for name in contacts:
        # .title() just makes the first letter capital when printing
        print(name.title() + " - " + contacts[name])


# ---------------------------------------------------
# Function to search a contact by name
# ---------------------------------------------------
def search_contact():
    name = input("Enter name to search: ")
    name = name.lower().strip()

    if name in contacts:
        print("Found:", name.title(), "-", contacts[name])
    else:
        print("Contact not found.")


# ---------------------------------------------------
# Function to update an existing contact
# ---------------------------------------------------
def update_contact():
    name = input("Enter name to update: ")
    name = name.lower().strip()

    if name in contacts:
        new_phone = input("Enter new phone number: ")
        contacts[name] = new_phone
        print("Contact updated successfully!")
    else:
        print("Contact not found.")


# ---------------------------------------------------
# Function to delete a contact
# ---------------------------------------------------
def delete_contact():
    name = input("Enter name to delete: ")
    name = name.lower().strip()

    if name in contacts:
        del contacts[name]
        print("Contact deleted successfully!")
    else:
        print("Contact not found.")


# ---------------------------------------------------
# Main Menu Loop
# ---------------------------------------------------
while True:
    print("\n--- Contact Book Menu ---")
    print("1. Add Contact")
    print("2. View Contacts")
    print("3. Search Contact")
    print("4. Update Contact")
    print("5. Delete Contact")
    print("6. Exit")

    choice = input("Enter your choice: ")

    if choice == "1":
        add_contact()
    elif choice == "2":
        view_contacts()
    elif choice == "3":
        search_contact()
    elif choice == "4":
        update_contact()
    elif choice == "5":
        delete_contact()
    elif choice == "6":
        print("Goodbye!")
        break
    else:
        print("Invalid choice, please try again.")