require 'keybow-pager/keybow'

button = {}

button.ACTION_A0 = 0
button.ACTION_A1 = 1
button.ACTION_A2 = 2

button.ACTION_B0 = 3
button.ACTION_B1 = 4
button.ACTION_B2 = 5

button.ACTION_C0 = 6
button.ACTION_C1 = 7
button.ACTION_C2 = 8

button.TAB_0 = 9
button.TAB_1 = 10
button.TAB_2 = 11

function button.set_color(button, color)
    if (color == nil) then
        keybow.set_pixel(button, 0, 0, 0)
    else
        keybow.set_pixel(button, color[1], color[2], color[3]) 
    end
end