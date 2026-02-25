<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="assets/images/logo/logo.png">
  <link rel="stylesheet" href="assets/styles/index.css">
  <title>Contactez COOP-CA COOPAAHS</title>
</head>

<body>
  <?php include('menu.php'); ?>
  <div class="home-page__background_contact">
    <h1 class="titre"><strong>Contactez-nous</strong></h1>
    <!-- <img src="" alt="Image de fond" class="home-page__image" class="produit-image"> -->
  </div>
  <div class="contact">
    <section class="partie1">
      <div class="email_telephone_whatssap">
        <p>
          <strong><img src="assets/images/icon/mail.png" alt="ddd" class="logo" />:</strong>
          <a href="mailto: anitchecoop@gmail.com">Envoyez Un Mail</a>
        </p>
        <p>
          <strong><img src="assets/images/icon/phone.png" alt="ddd" class="logo" />:</strong>
          <a href="tel:+2250769426094">Appelez-Nous</a>
        </p>
        <p>
          <strong><img src="assets/images/icon/whatsapp.png" alt="ddd" class="logo" /> :</strong>
          <a
            href="https://wa.me/225505782490">
            WhatsApp</a>
        </p>
        <p>
          <strong><img src="assets/images/icon/facebook.png" alt="ddd" class="logo" /> :</strong>
          <a href="https://www.facebook.com/share/17aS6xFc5J/?mibextid=wwXIfr">Facebook</a>
        </p>
        <div class="text">
          <p>
            Nous serons ravis de vous entendre et de répondre à vos questions. N'hésitez pas à nous
            contacter pour toute information ou assistance. Notre équipe est là pour vous aider.
          </p>

        </div>
      </div>
      <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15844.34283659214!2d-6.4484492822619695!3d6.880335143246325!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xfbbd9f44b4abda5%3A0xb0eaada5da4e7808!2sCOOPAA_%20HS!5e0!3m2!1sfr!2sci!4v1770809590997!5m2!1sfr!2sci"
          width="600"
          height="450"
          style="border:0;"
          allowfullscreen=""
          loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </section>
    <h1>Formulaire de contact</h1>
    <section id="contact">
      <div class="form">
        <form action="" id="contactForm">
          <input type="text" placeholder="votre nom " id="name" required />
          <input type="email" placeholder="votre e-mail " id="email" required />
          <input type="text" placeholder="l'objet " id="subject" required />
          <textarea
            name=""
            id="message"
            cols="30"
            rows="10"
            placeholder="votre message"
            required></textarea>
          <button type="submit" class="infobtn">Envoyer</button>
        </form>
      </div>
      <div class="membre">
        <h1>Nos responsables et Partenaires</h1>
        <div class="perso">
          <img src="assets/images/icon/icon.png" alt="PCA" class="logo" />
          <ul>
            <li>
              <b>KANE SENOU</b>
            </li>
            <li>tel:07 07 91 75 24</li>
            <li>PCA</li>
            <li><a href="mailto:infos@coopaahs.com">infos@coopaahs.com</a></li>
          </ul>
        </div>
        <div class="perso">
          <img src="assets/images/icon/icon.png" alt="DIRECTEUR" class="logo" />
          <ul>
            <li>
              <b>KANE MAMOUTOU</b>
            </li>
            <li>tel:07 08 72 64 20</li>
            <li>DIRECTEUR</li>
            <li><a href="mailto:mamoutou@coopaahs.com">mamoutou@coopaahs.com</a></li>
          </ul>
        </div>
        <div class="perso">
          <img src="assets/images/icon/partenaire.png" alt="PARTENAIRE" class="logo" />
          <ul>
            <li>
              <b> DIGITAL KPADJALE</b>
            </li>
            <li>tel:+2250705694004</li>
          </ul>
        </div>
      </div>
    </section>
  </div>
  <?php include 'footer.php'; ?>
  <script>
    document.getElementById("contactForm").addEventListener("submit", function(e) {
      e.preventDefault(); // Empêche l'envoi classique du formulaire 
      //  Récupération des valeurs 
      const name = document.getElementById("name").value;
      const email = document.getElementById("email").value;
      const subject = document.getElementById("subject").value;
      const message = document.getElementById("message").value;
      // Adresse email du destinataire (administrateur)
      const to = "anitchecoop@gmail.com";
      // Corps du mail 
      const body = `Nom: ${name}%0AEmail: ${email}%0AObjet: ${subject}%0A%0AMessage:%0A${message}`;
      // Lien mailto 
      const mailtoLink = `mailto:${to}?subject=${encodeURIComponent(subject)}&body=${body}`;
      // Ouvrir le client mail
      window.location.href = mailtoLink;
    });
  </script>
</body>

</html>