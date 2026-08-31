# ---------------------------------------------------
# Task 3: Banking System in Python
# ---------------------------------------------------
# This program lets the user:
#   1. Create an account (Name and Initial Balance)
#   2. Check balance
#   3. Deposit money
#   4. Withdraw money (only if sufficient balance)
#   5. Exit
# Account details are stored using a simple dictionary
# ---------------------------------------------------

# Dictionary to store account info
# Starts empty until the user creates an account
account = {}


# ---------------------------------------------------
# Function to create a new account
# ---------------------------------------------------
def create_account():
    name = input("Enter name: ")
    balance = int(input("Enter initial balance: "))

    account["name"] = name
    account["balance"] = balance
    print("Account created!")


# ---------------------------------------------------
# Function to check balance
# ---------------------------------------------------
def check_balance():
    if "balance" not in account:
        print("No account found. Please create an account first.")
        return

    print(account["name"] + "'s balance:", account["balance"])


# ---------------------------------------------------
# Function to deposit money
# ---------------------------------------------------
def deposit():
    if "balance" not in account:
        print("No account found. Please create an account first.")
        return

    amount = int(input("Enter amount to deposit: "))
    account["balance"] = account["balance"] + amount
    print("Deposit successful!")


# ---------------------------------------------------
# Function to withdraw money
# ---------------------------------------------------
def withdraw():
    if "balance" not in account:
        print("No account found. Please create an account first.")
        return

    amount = int(input("Enter amount to withdraw: "))

    # only allow withdrawal if there is enough balance
    if amount <= account["balance"]:
        account["balance"] = account["balance"] - amount
        print("Withdrawal successful!")
    else:
        print("Insufficient balance!")


# ---------------------------------------------------
# Main Menu Loop
# ---------------------------------------------------
print("Welcome to MyBank!")

while True:
    print("\n1. Create Account")
    print("2. Check Balance")
    print("3. Deposit")
    print("4. Withdraw")
    print("5. Exit")

    choice = input("Enter choice: ")

    if choice == "1":
        create_account()
    elif choice == "2":
        check_balance()
    elif choice == "3":
        deposit()
    elif choice == "4":
        withdraw()
    elif choice == "5":
        print("Thank you for using MyBank!")
        break
    else:
        print("Invalid choice, please try again.")