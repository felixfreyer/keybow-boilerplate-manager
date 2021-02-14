require 'keybow-pager/keybow'
require 'keybow-pager/buttons'
require 'keybow-pager/colors'
require 'keybow-pager/pages'

function setup() 
    keybow.auto_lights(false)
    keybow.clear_lights()
    pages.set_page(pages.PAGE_0)
end

-- Key mappings --

function handle_key_00(pressed)
    if (pressed) then
        pages.run_operation(button.ACTION_A0)
    end
end

function handle_key_01(pressed)
    if (pressed) then
        pages.run_operation(button.ACTION_A1)
    end
end

function handle_key_02(pressed)
    if (pressed) then
        pages.run_operation(button.ACTION_A2)
    end
end

function handle_key_03(pressed)
    if (pressed) then
        pages.run_operation(button.ACTION_B0)
    end
end

function handle_key_04(pressed)
    if (pressed) then
        pages.run_operation(button.ACTION_B1)
    end
end

function handle_key_05(pressed)
    if (pressed) then
        pages.run_operation(button.ACTION_B2)
    end
end

function handle_key_06(pressed)
    if (pressed) then
        pages.run_operation(button.ACTION_C0)
    end
end

function handle_key_07(pressed)
    if (pressed) then
        pages.run_operation(button.ACTION_C1)
    end
end

function handle_key_08(pressed)
    if (pressed) then
        pages.run_operation(button.ACTION_C2)
    end
end

function handle_key_09(pressed)
    if (pressed) then
        pages.set_page(pages.PAGE_0)
    end
end

function handle_key_10(pressed)
    if (pressed) then
        pages.set_page(pages.PAGE_1)
    end
end

function handle_key_11(pressed)
    if (pressed) then
        pages.set_page(pages.PAGE_2)
    end
end