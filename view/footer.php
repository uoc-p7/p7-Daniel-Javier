<?php ?>
</div>

        <!--FOOTER-->

    </div>
    <div id="footer">

        <p> &copy; RETURN CODE <?=date('Y')?>.   
            <?php
                if(isset($_SESSION["username"])){
                    echo " Usuario: ".$_SESSION["username"]." <a href='model/cerrar_sesion.php'>Cerrar sesión</a>";
                }else{
                    echo " Sesión no iniciada.";
                }
            ?>
        </p>
    </div>
</body>

</html>