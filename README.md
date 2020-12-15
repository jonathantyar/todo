##Backend Assignment
Author: Jonathan Tyar :)

###BonusPoint
- [x] Make your API using hexagonal architecture and/or DDD concepts
- [x] Use TDD (and commit in order so we can see)
- [ ] Use an event store and/or message bus (and related concepts) to (re)create state
- [ ] Write a docker(-compose) and/or kubernetes configuration for easy setup
- [ ] Consume your own API in a frontend using a modern javascript framework

###Features
1. [x] The user can show, create, update, or delete a section.
2. [x] The user can create, update, or delete a task.
3. [x] The user can show tasks of a section.
4. [x] The user can change the state of the task from todo to done or from done to todo.
5. [x] The user can filter the tasks by the state.
6. [x] The user can search a task
7. [x] Show timestamp of created task in human format readable time (ie: 1 hour ago)
8. [x] The tasks must be chronologically displayed within a section. The newest created task comes first.
9. [x] Each section or task must be accessible via an URL. (ie: /sections/34, /sections/34/tasks/24, /tasks/24)
10. [x] Create fixtures and/or seeders with some randomness.
11. [x] Add the caching mechanism of your choice.
12. [ ] The user can also create a task from a command in the command line.
13. [ ] The user can also change the status of a task from the command line.
14. [ ] Create a command-line that will send by email the integrality of the task list to nsa@example.net
15. [ ] The user can undo an action he did on a task or a section.
