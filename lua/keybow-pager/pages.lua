require 'keybow-pager/keybow'
require 'keybow-pager/colors'
require 'keybow-pager/buttons'
require 'keybow-pager/operations'

-- Support three pages of commands. 
pages = {}
pages.PAGE_0 = 0
pages.PAGE_1 = 1
pages.PAGE_2 = 2

pages.button_map = {    
    button.ACTION_A0, button.ACTION_A1, button.ACTION_A2,
    button.ACTION_B0, button.ACTION_B1, button.ACTION_B2,
    button.ACTION_C0, button.ACTION_C1, button.ACTION_C2
}

-- the current page. Default at startup is PAGE_0.
pages.page = pages.PAGE_0

function pages.set_page(page_)
    pages.page = page_
    button.set_color(button.TAB_0, color.WHITE)
    button.set_color(button.TAB_1, color.WHITE)
    button.set_color(button.TAB_2, color.WHITE)
    if (pages.page == pages.PAGE_0) then
        button.set_color(button.TAB_0, color.MOONLIGHT)
    elseif (pages.page == pages.PAGE_1) then
        button.set_color(button.TAB_1, color.MOONLIGHT)
    elseif (pages.page == pages.PAGE_2) then
        button.set_color(button.TAB_2, color.MOONLIGHT)
    end
    
    for i = 1, 9, 1
    do
        button.set_color(pages.button_map[i], color.WHITE)
    end
end

function pages.get_operation_for_action_button(button_id)
    for i = 1, 9, 1
    do
        if (pages.button_map[i] == button_id) then
            return operations.boilerplate(tostring(pages.page + 1),tostring(i))
        end
    end
    return nil
end

function pages.run_operation(button_id)
    operation = pages.get_operation_for_action_button(button_id)
    if (operation ~= nil) then
        operation()
    end
end