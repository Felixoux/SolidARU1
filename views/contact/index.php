<?php

if (isset($_POST['name']) && isset($_POST['content']) && isset($_POST['mail'])) {
    $name = e($_POST['name']);
    $mail = e($_POST['mail']);
    $topic = e($_POST['topic']);
    $content = e($_POST['content']);

    $content = <<<HTML
    <h1>Mail envoyé par <strong>$name</strong> | $mail</h1> <br>
    <h3>$content</h3>
HTML;



    $headers  = "From: " . $mail . "\r\n";
    $headers .= "Reply-To: " . $mail . "\r\n";
    $headers .= "CC: $mail\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";


    $coucou = mail(
        C('mail'),
        $topic,
        $content,
        $headers
    );
}

?>
<h1 class="big-title page-header container">Nous <strong>contacter ?</strong></h1>
<svg class="contact-wave" id="wave" style="transform:rotate(0deg); transition: 0.3s" viewBox="0 0 1440 490"
     xmlns="http://www.w3.org/2000/svg"><defs><linearGradient id="sw-gradient-0" x1="0" x2="0" y1="1" y2="0"><stop stop-color="rgba(255, 136, 61, 1)" offset="0%"/><stop stop-color="rgba(255, 136, 61, 1)" offset="100%"/></linearGradient></defs><path style="transform:translate(0, 0px); opacity:1" fill="url(#sw-gradient-0)" d="M0,343L60,302.2C120,261,240,180,360,163.3C480,147,600,196,720,253.2C840,310,960,376,1080,400.2C1200,425,1320,408,1440,359.3C1560,310,1680,229,1800,220.5C1920,212,2040,278,2160,261.3C2280,245,2400,147,2520,163.3C2640,180,2760,310,2880,302.2C3000,294,3120,147,3240,81.7C3360,16,3480,33,3600,106.2C3720,180,3840,310,3960,326.7C4080,343,4200,245,4320,204.2C4440,163,4560,180,4680,163.3C4800,147,4920,98,5040,98C5160,98,5280,147,5400,138.8C5520,131,5640,65,5760,40.8C5880,16,6000,33,6120,106.2C6240,180,6360,310,6480,302.2C6600,294,6720,147,6840,130.7C6960,114,7080,229,7200,302.2C7320,376,7440,408,7560,408.3C7680,408,7800,376,7920,326.7C8040,278,8160,212,8280,179.7C8400,147,8520,147,8580,147L8640,147L8640,490L8580,490C8520,490,8400,490,8280,490C8160,490,8040,490,7920,490C7800,490,7680,490,7560,490C7440,490,7320,490,7200,490C7080,490,6960,490,6840,490C6720,490,6600,490,6480,490C6360,490,6240,490,6120,490C6000,490,5880,490,5760,490C5640,490,5520,490,5400,490C5280,490,5160,490,5040,490C4920,490,4800,490,4680,490C4560,490,4440,490,4320,490C4200,490,4080,490,3960,490C3840,490,3720,490,3600,490C3480,490,3360,490,3240,490C3120,490,3000,490,2880,490C2760,490,2640,490,2520,490C2400,490,2280,490,2160,490C2040,490,1920,490,1800,490C1680,490,1560,490,1440,490C1320,490,1200,490,1080,490C960,490,840,490,720,490C600,490,480,490,360,490C240,490,120,490,60,490L0,490Z"/><defs><linearGradient id="sw-gradient-1" x1="0" x2="0" y1="1" y2="0"><stop stop-color="rgba(30, 37, 82, 1)" offset="0%"/><stop stop-color="rgba(30, 37, 82, 1)" offset="100%"/></linearGradient></defs><path style="transform:translate(0, 50px); opacity:1" fill="url(#sw-gradient-1)" d="M0,392L60,359.3C120,327,240,261,360,228.7C480,196,600,196,720,236.8C840,278,960,359,1080,367.5C1200,376,1320,310,1440,310.3C1560,310,1680,376,1800,392C1920,408,2040,376,2160,318.5C2280,261,2400,180,2520,122.5C2640,65,2760,33,2880,32.7C3000,33,3120,65,3240,138.8C3360,212,3480,327,3600,367.5C3720,408,3840,376,3960,326.7C4080,278,4200,212,4320,220.5C4440,229,4560,310,4680,285.8C4800,261,4920,131,5040,73.5C5160,16,5280,33,5400,73.5C5520,114,5640,180,5760,187.8C5880,196,6000,147,6120,138.8C6240,131,6360,163,6480,220.5C6600,278,6720,359,6840,400.2C6960,441,7080,441,7200,441C7320,441,7440,441,7560,408.3C7680,376,7800,310,7920,285.8C8040,261,8160,278,8280,253.2C8400,229,8520,163,8580,130.7L8640,98L8640,490L8580,490C8520,490,8400,490,8280,490C8160,490,8040,490,7920,490C7800,490,7680,490,7560,490C7440,490,7320,490,7200,490C7080,490,6960,490,6840,490C6720,490,6600,490,6480,490C6360,490,6240,490,6120,490C6000,490,5880,490,5760,490C5640,490,5520,490,5400,490C5280,490,5160,490,5040,490C4920,490,4800,490,4680,490C4560,490,4440,490,4320,490C4200,490,4080,490,3960,490C3840,490,3720,490,3600,490C3480,490,3360,490,3240,490C3120,490,3000,490,2880,490C2760,490,2640,490,2520,490C2400,490,2280,490,2160,490C2040,490,1920,490,1800,490C1680,490,1560,490,1440,490C1320,490,1200,490,1080,490C960,490,840,490,720,490C600,490,480,490,360,490C240,490,120,490,60,490L0,490Z"/>
</svg>
<main class="contact-wrapper">
    <section class="ASBL">
        <h2 class="section-title">Coordonnées</h2>
        <div class="card stack p2">
            <p>Pour nous contacter, rien de plus simple. Il suffit de nous écrire via ce mail.</p>
            <h3 class="medium-title"><a href="mailto:lesamisaru1@gmail.com">lesamisaru1@gmail.com</a></h3>
            <p>Envie de ne rien rater ? Retrouvez nous aussi sur facebook juste ici :</p>
            <h3 class="medium-title"><a href="https://www.facebook.com/pages/category/Nonprofit-organization/Les-Amis-de-LAru1-104390721107594/">Page facebook de l'ASBL</a></h3>
        </div>
    </section>
    <section class="ARU1">
        <hr>
        <h3 class="section-title">Coordonnées de l'<strong>ARU1</strong></h3>
        <ul class="aru1-contact-list">
            <li>87, avenue Houzeau</li>
            <li>1180 Bruxelles</li>
            <li><a href="tel:+32 2 374 05 84">Téléphone : 02/ 374 05 84</a></li>
            <li><a href="tel: +32 2 375 28 91">Fax : 02/ 375 28 91</a></li>
        </ul>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2521.614043653439!2d4.356331615975724!3d50.80126096990542!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c3c503f0f2ad69%3A0x7a802c2952bdeeee!2sAv.%20Houzeau%2087%2C%201180%20Uccle!5e0!3m2!1sfr!2sbe!4v1652801724282!5m2!1sfr!2sbe" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>
    <section class="contact-form">
        <hr class="mobile-only">
        <h2 class="section-title">Formulaire</h2>
        <h4>
            Vous avez une question, un avis, un commentaire quelconque sur le site ? <br>
            Vous pouvez nous écrire juste ici en remplissant le formulaire
        </h4>
        <?php require VIEW_PATH . '/contact/_form.php'; ?>
    </section>
</main>
