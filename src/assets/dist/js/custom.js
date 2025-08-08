document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.theme-card-radio').forEach(card => {
        const radio = card.querySelector('.form-check-input');

        card.addEventListener('click', function(e) {
            if (e.target !== radio) {
                radio.checked = true;
                radio.dispatchEvent(new Event('change'));
            }
        });
    });

    if (document.getElementById('collapseSidebarGradient')) {
        Array.from(document.querySelectorAll("#collapseSidebarGradient .form-check input")).forEach(function (subElem) {
            var myCollapse = document.getElementById('collapseSidebarGradient')
            if ((subElem.checked == true)) {
                var bsCollapse = new bootstrap.Collapse(myCollapse, {
                    toggle: false,
                })
                bsCollapse.show()
            }

            if (document.querySelector("[data-bs-target='#collapseSidebarGradient']")) {
                document.querySelector("[data-bs-target='#collapseSidebarGradient']").addEventListener('click', function (elem) {
                    document.getElementById("sidebarsideb-gradient").click();
                });
            }
        });
    }

    if (document.querySelectorAll("[data-bs-target='#collapseSidebarGradient.show']")) {
        Array.from(document.querySelectorAll("[data-bs-target='#collapseSidebarGradient.show']")).forEach(function (subElem) {
            subElem.addEventListener("click", function(){
                var myCollapse = document.getElementById('collapseSidebarGradient')
                var bsCollapse = new bootstrap.Collapse(myCollapse, {
                    toggle: false,
                })
                bsCollapse.hide()
            })
        });
    }

    Array.from(document.querySelectorAll("[name='data-sidebar']")).forEach(function (elem) {
        if (document.querySelector("[data-bs-target='#collapseSidebarGradient']")) {
            if (document.querySelector("#collapseSidebarGradient .form-check input:checked")) {
                document.querySelector("[data-bs-target='#collapseSidebarGradient']").classList.add("active");
            } else {
                document.querySelector("[data-bs-target='#collapseSidebarGradient']").classList.remove("active");
            }

            elem.addEventListener("change", function () {
                if (document.querySelector("#collapseSidebarGradient .form-check input:checked")) {
                    document.querySelector("[data-bs-target='#collapseSidebarGradient']").classList.add("active");
                } else {
                    document.querySelector("[data-bs-target='#collapseSidebarGradient']").classList.remove("active");
                }
            })
        }
    })
});