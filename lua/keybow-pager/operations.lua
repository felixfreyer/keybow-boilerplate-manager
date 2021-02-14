require 'keybow-pager/keybow'

operations = {}

function operations.boilerplate(page, key)
    spotlight("terminal")
    keybow.tap_enter()
    keybow.text("Developer&keybow/boilerplate/manager&shell&boilerplate.sh " .. page .. " " .. key)
    keybow.tap_enter()
    keybow.sleep(500)
    keybow.text("exit")
    keybow.tap_enter()
    backToLastApp()
    keybow.sleep(500)
    pasteText()
end

function pasteText()
    modifier("v", keybow.LEFT_META)
end

function backToLastApp()
    modifier(keybow.TAB, keybow.LEFT_META)
end

function spotlight(command)
    modifier(keybow.SPACE, keybow.LEFT_META)
    keybow.sleep(500)
    keybow.text(command)
    keybow.sleep(500)
    keybow.tap_enter()
    keybow.sleep(500)
end

function modifier(key, ...)
    for i = 1, select('#', ...) do
        local j = select(i, ...)
        keybow.set_modifier(j, keybow.KEY_DOWN)
    end
    keybow.tap_key(key)
    for i = 1, select('#', ...) do
        local j = select(i, ...)
        keybow.set_modifier(j, keybow.KEY_UP)
    end
end