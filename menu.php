<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/app.css">
    <title>le menu</title>
</head>

<body>
    <nav class="menu">
        <P> <img src="assets/images/logo/logo.png" alt="Logo" class="logo">
        <h1>COOP-CA COOPAAHS</h1>
        </P>
        <button class="menu-toggle" aria-controls="main-nav" aria-expanded="false" id="menu-toggleO">
            ☰
        </button>
        <ul class="Main-Nav">
            <button class="menu-toggle" aria-controls="main-nav" aria-expanded="false" id="menu-toggleF">
                ☰
            </button>
            <li id="acceuil1" class="">
                <a href="index.php"></a>
            </li>
            <li id="produit1" class="">
                <a href="produit.php">Activites</a>
            </li>
            <li id="activite1" class="">
                <a href="activite.php">Actions Sociales</a>
            </li>

            <li id="apropos1" class="">
                <a href="durabilite.php">Durabilité</a>
            </li>
            <li id="apropos1" class="">
                <a href="zones.php">Zones</a>
            </li>
            <li id="apropos1" class="">
                <a href="apropos.php">A Propos</a>
            </li>
            <li id="contact1" class="">
                <a href="contact.php">Contact</a>
            </li>
        </ul>
    </nav>
    <script>
        const links = document.querySelectorAll(" li a");
        const currentPage = window.location.pathname.split("/").pop();

        links.forEach(link => {
            if (link.getAttribute("href") === currentPage) {
                link.parentElement.classList.add("active");
            }
        });
        // Menu toggle functionality
        const menuToggleO = document.getElementById('menu-toggleO');
        const menuToggleF = document.getElementById('menu-toggleF');
        const mainNav = document.querySelector('.Main-Nav');

        // Quand on clique sur menuToggleO → ajouter la classe "open"
        menuToggleO.addEventListener('click', () => {
            mainNav.classList.add('open');
        });

        // Quand on clique sur menuToggleF → retirer la classe "open"
        menuToggleF.addEventListener('click', () => {
            mainNav.classList.remove('open');
        });
    </script>
</body>

</html>