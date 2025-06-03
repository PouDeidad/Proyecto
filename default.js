        var elmero = new Audio("audio/elmero.mp3");
        function cambiar() {
            const texto = document.getElementById('bus').value;

            if (texto=="el mero mero"){
                elmero.loop = true;
                elmero.play();
            }
            if (texto=="reportes semanales"){
                location.href = "reportes_sem.php";
            }
            if (texto=="reportes mensuales"){
                location.href = "reportes_men.php";
            }
            if (texto=="objetivo"){
                location.href = "objetivo.html";
            }
            if (texto=="estructura"){
                location.href = "estructura.html";
            }
            if (texto=="lugares"){
                location.href = "lugares.html";
            }
            if (texto=="beneficios"){
                location.href = "beneficios.html";
            }
            if (texto=="audiencia"){
                location.href = "audiencia.html";
            }
            if (texto=="contactos"){
                location.href = "contactos.html";
            }
            if (texto=="empresa"){
                location.href = "empresa.html";
            }
            if (texto=="conclusion"){
                location.href = "conclusion.html";
            }
            if (texto=="admin"){
                location.href = "admin.php";
            }
        }
        function en() {
            if (event.keyCode == 13) {
                cambiar();
            }
        }

        function sem() {
            document.getElementById("bus").value = "reportes semanales";
            cambiar();
        }
        function men() {
            document.getElementById("bus").value = "reportes mensuales";
            cambiar();
        }
        function obj() {
            document.getElementById("bus").value = "objetivo";
            cambiar();
        }
        function esc() {
            document.getElementById("bus").value = "estructura";
            cambiar();
        }
        function lug() {
            document.getElementById("bus").value = "lugares";
            cambiar();
        }
        function ben() {
            document.getElementById("bus").value = "beneficios";
            cambiar();
        }
        function aud() {
            document.getElementById("bus").value = "audiencia";
            cambiar();
        }
        function con() {
            document.getElementById("bus").value = "contactos";
            cambiar();
        }
        function emp() {
            document.getElementById("bus").value = "empresa";
            cambiar();
        }
        function conclu() {
            document.getElementById("bus").value = "conclusion";
            cambiar();
        }
        function adm() {
            document.getElementById("bus").value = "admin";
            cambiar();
        }