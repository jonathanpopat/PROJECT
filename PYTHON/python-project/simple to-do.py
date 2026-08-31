# simple to-do list 

tasks = []

while True:
    print("\nTo-Do List:")
    print("\nview. Tasks To-DO")
    print("add. Add Task")    
    print("remove. Remove Task")
    print("exit. Exit")

    choice = input('Enter task: ')

    

    if choice == 'view':
        if len(tasks)== 0:
            print("No tasks, enter new to add a task.")
        else:
            print('\nTasks:')
            for i, task in enumerate(tasks, 1):
                print(f"{i}. {task}")

    elif choice == 'add':
        task = input('Add new task: ')
        tasks.append(task)
        print("Task added.")
        print('Current Tasks:', tasks)

    
    elif choice == "remove":
        if len(tasks) == 0:
            print("No tasks to remove.")
        else:
            for i, task in enumerate(tasks, start=1):
                print(f"{i}. {task}")

            task_num = int(input("Enter task number to remove: "))

            if 1 <= task_num <= len(tasks):
                removed = tasks.pop(task_num - 1)
                print(f"Removed: {removed}")
            else:
                print("Invalid task number.")

    
    elif choice == "exit":
        print("See Ya!")
        break
    else:  
            print("Invalid choice. Try again.")