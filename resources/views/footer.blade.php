<div class="mobile-footer">
    <footer class="hidden">
        <div class="footer-menu">
            <a href="{{ url('/add-counter-reading') }}">
                <div class="footer-menu-element" data-name="add-counter-reading">
                    <img src="{{ asset("img/icons/table-plus.svg") }}" alt="">
                    <span>Новое показание</span>
                </div>
            </a>

            <a href="{{ url('/masters') }}">
                <div class="footer-menu-element" data-name="masters">
                    <img src="{{ asset("img/icons/users.svg") }}" alt="">
                    <span>Мастера</span>
                </div>
            </a>

            <a href="{{ url('/projects') }}">
                <div class="footer-menu-element" data-name="projects">
                    <img src="{{ asset("img/icons/crane.svg") }}" alt="">
                    <span>Проекты</span>
                </div>
            </a>

{{--            <a href="{{ url('/counters') }}">--}}
{{--                <div class="footer-menu-element" data-name="counters">--}}
{{--                    <img src="{{ asset("img/icons/server-bolt.svg") }}" alt="">--}}
{{--                    <span>Счётчики</span>--}}
{{--                </div>--}}
{{--            </a>--}}

            <a href="{{ url('/equipment') }}">
                <div class="footer-menu-element" data-name="equipment">
                    <img src="{{ asset("img/icons/backhoe.svg") }}" alt="">
                    <span>Оборудование</span>
                </div>
            </a>

            <a href="{{ url('/profile') }}">
                <div class="footer-menu-element" data-name="profile">
                    <img src="{{ asset("img/icons/user.svg") }}" alt="">
                    <span>Профиль</span>
                </div>
            </a>
        </div>
    </footer>
</div>

<style>
    .mobile-footer {
        position: fixed;
        width: 100%;
        height: 60px;
        bottom: 0;
        left: 0;
        background-color: #fff;
        z-index: 30;
    }

    .mobile-footer footer {
        position: relative;
        width: 100%;
        height: 100%;
        border-top: 1px solid rgba(0, 0, 0, .2);
    }

    .mobile-footer .footer-menu {
        position: relative;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: space-around;
    }
    .mobile-footer a {
        flex: 1;
        text-decoration: none !important;
        color: unset !important;
    }
    .mobile-footer .footer-menu-element {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        opacity: .5;
    }
    .mobile-footer .footer-menu-element.selected {
        opacity: 1;
    }
    .mobile-footer .footer-menu-element img {
        opacity: .7;
    }
    .mobile-footer .footer-menu-element span {
        white-space: nowrap;
        font-size: 9px;
    }
    .mobile-footer .footer-menu-element.selected img {
        opacity: 1;
    }

    footer.hidden {
        display: none;
    }
</style>

<script>
    function selectFooterTab(name) {
        $(".mobile-footer .footer-menu-element").removeClass("selected");
        $(".mobile-footer .footer-menu-element[data-name='" + name + "']").addClass("selected");

        $("header .tabs li a").removeClass("selected");
        $("header .tabs li[data-name='" + name + "'] a").addClass("selected");
    }

    function hideFooterTabs() {
        console.log("hideFooterTabs is running")
        if (localStorage.getItem("user_role_id") == null) {
            console.log("user_role_id is null")
            $("footer").addClass("hidden");
            $("header").addClass("hidden");

            setTimeout(() => {
                hideFooterTabs();
            }, 100)
            return;
        }

        console.log("user_role_id is not null", localStorage.getItem("user_role_id"));

        if (localStorage.getItem("user_role_id") == 1) {
            console.log("master")
            $(".footer-menu-element[data-name='masters']").parent().remove();
            // $(".footer-menu-element[data-name='projects']").parent().remove();
            $(".footer-menu-element[data-name='equipment']").parent().remove();

            $("header .tabs li[data-name='masters']").remove();
            // $("header .tabs li[data-name='projects']").remove();
            $("header .tabs li[data-name='equipment']").remove();
        }
        $("footer").removeClass("hidden");
        $("header").removeClass("hidden");
    }

    hideFooterTabs();
</script>


