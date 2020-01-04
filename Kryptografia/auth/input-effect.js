const InputEffect = function () {
    let placeholderPosition, actions;
    const activeColor = "rgba(255, 255, 255, .9)";
    const inactiveColor = "rgba(255, 255, 255, .5)";


    actions = {
        activate: function (el) {
            el.parentElement.style.color = activeColor;
            el.parentElement.style.borderBottomColor = activeColor;
        },
    deactivate: function (el) {
        el.parentElement.style.color = inactiveColor;
        el.parentElement.style.borderBottomColor = inactiveColor;
    }
    };

    placeholderPosition = function (el) {
        if (el.value !== '') actions.activate(el);
        el.addEventListener('focus', function () {
            actions.activate(this)
        });
        el.addEventListener('blur', function () {
            actions.deactivate(this)
        });
    };

    document.querySelectorAll('.form-in').forEach(function (el) {
        placeholderPosition(el);
    })
};

InputEffect();