# keybow-boilerplate-manager
Feb 14th, 2021


![](https://github.com/felixfreyer/keybow-boilerplate-manager/raw/main/images/keybow.jpg)

**Figure 1: Keybow**

![](https://github.com/felixfreyer/keybow-boilerplate-manager/raw/main/images/keybow-boilerplate-manager-1.jpg)

**Figure 2: Keybow Boilerplate Manager**


## About this project

The aim of this project is to be able to insert boilerplate code with the keybow at the touch of a button. The boilerplates are saved in a database and can be managed via web interface. This means that it's no longer necessary to rewrite the SD card. Moreover codes can be quickly added, edited, sorted and removed.
Thanks to stefanoborini for his project [keybow-pager](https://github.com/stefanoborini/keybow-pager) which is the perfect basis for the keybow software.




## Installation

### Keybow Software
The original Pimoroni Keybow firmware must be installed. After that the content of the lua directory needs to be copied to the root directory of the SD card.

### Mac Software
By default, the shell script needs to be stored in the directory Developer/keybow-boilerplate-manager/shell/ on your Mac. To change this, just replace the path in the operations.lua file. Since the keybow is recognized as a hid device with qwerty layout, i needed to adjust the path string for my german qwertz keyboard layout. If you use a US/UK layout, make sure you adjust the path string ( & is /  and - is / ).

The web interface can be run on MAMP and the required database sql file can be imported with phpMyAdmin.

For convenience, the web interface can be opened with Automator in a website popup by a keyboard shortcut. The needed files are stored in the automator directory. The workflow file opens the app and focusses it, so the web interface can be navigated by keyboard. On a Mac, workflow files can be executed via keyboard shortcut by the following system setting:

System Settings > Keyboard > Shortcuts > Services > Select keybow-boilerplate-manager and select a shortcut.




## Boilerplate Manager Web Interface
With the boilerplate manager, code snippets can be quickly added, edited, sorted and removed.
Navigation is done by the keyboard arrow keys as well as the enter key.
The website popup is automatically focussed and can be dismissed by pressing escape.

![](https://github.com/felixfreyer/keybow-boilerplate-manager/raw/main/images/keybow-boilerplate-manager-2.jpg)

**Figure 3: Keybow Boilerplate Manager**

![](https://github.com/felixfreyer/keybow-boilerplate-manager/raw/main/images/keybow-boilerplate-manager-3.jpg)

**Figure 4: Keybow Boilerplate Manager**


## Keybow GPIO

|     |   |    |    |
|-----|---|----|----|
| TAB | 9 | 10 | 11 |
| C   | 6 | 7  | 8  |
| B   | 3 | 4  | 5  |
| A   | 0 | 1  | 2  |




## TBD
- Modal keyboard navigation is currently done by arrow up / down. Arrow left / right should be implemented for convenience and intuitive navigation.
- Disable enter and esc key on modal inputs and text areas.
- Possibility to add, edit and sort categories.