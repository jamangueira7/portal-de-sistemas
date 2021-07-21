<script type="text/javascript">

    window.onload = function() {
        inactivityTime();
    }

    var inactivityTime = function () {
        var time = 0;
        window.onload = resetTimer;
        // DOM Events
        document.onmousemove = resetTimer;
        document.onkeydown = resetTimer;

        function logout() {
            window.location = '/logout'
        }

        function resetTimer() {
            time = 0;
        }


        document.onload = resetTimer;
        document.onmousemove = resetTimer;
        document.onmousedown = resetTimer; // touchscreen presses
        document.ontouchstart = resetTimer;
        document.onclick = resetTimer;     // touchpad clicks
        document.onkeydown = resetTimer;   // onkeypress is deprectaed
        document.addEventListener('scroll', resetTimer, true); // improved; see comments

        window.addEventListener('load', resetTimer, true);
        var events = ['mousedown', 'mousemove', 'keypress', 'scroll', 'touchstart'];
        events.forEach(function(name) {
            document.addEventListener(name, resetTimer, true);
        });

        setInterval(function(){
            time = parseInt(time) + 1;
        }, 1000);

        setInterval(function(){
            if(time > 1200 && time < 1500) {
                $("#alert-warning").css("display", "block");

                if($("#time-warning").text() == "00:00") {
                    const today = new Date();
                    today.setMinutes(today.getMinutes() + 5);
                    $("#time-warning").text(today.getHours() + ":" + today.getMinutes());
                }
            }

            if(time > 1500) {
                $("#alert-warning").css("display", "none");
                logout();
            }
        }, 60000);
    };
</script>
