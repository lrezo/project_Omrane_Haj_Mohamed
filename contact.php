<?php
// Show all errors (for educational purposes)
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

const DB_HOST = 'localhost';
const DB_USER = 'omran';
const DB_PASS = '00122244377Pentagon';
const DB_NAME = 'contactmeomran';
// Verbinding maken met de databank
try {
    $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
echo 'Verbindingsfout: ' . $e->getMessage();
exit;
}

$name = isset($_POST['name']) ? (string)$_POST['name'] : '';
$message = isset($_POST['message']) ? (string)$_POST['message'] : '';
$email = isset($_POST['email']) ? (string)$_POST['email'] : '';
$subject = isset($_POST['subject']) ? (string)$_POST['subject'] : '';
$msgName = '';
$msgEmail = '';
$msgMessage = '';
$msg_found_me='';
$msgSubject = '';

// form is sent: perform formchecking!
if (isset($_POST['btnSubmit'])) {

$allOk = true;

// name not empty
if (trim($name) === '') {
$msgName = 'Please enter a name';
$allOk = false;
}

if (trim($message) === '') {
$msgMessage = 'Please enter a message';
$allOk = false;
}
if (trim($subject) === '') {
    $msgSubject = 'Please enter a subject';
    $allOk = false;
}
if (trim($email) === '') {
$msgEmail = 'Please enter an email';
$allOk = false;
}



// end of form check. If $allOk still is true, then the form was sent in correctly
if ($allOk) {
// build & execute prepared statement
$stmt = $db->prepare('INSERT INTO messages (name, email, subject,message, added_on) VALUES (?, ?, ?,?,?)');
$stmt->execute(array($name,$email,$subject, $message, (new DateTime())->format('Y-m-d H:i:s')));

// the query succeeded, redirect to this very same page
if ($db->lastInsertId() != 0) {
header('Location: formchecking_thanks.php?name=' . urlencode($name));
exit();
} // the query failed
else {
echo 'Databankfout.';
exit;
}

}

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/contact.css">
    <link rel="icon" type="image/x-icon" href="./img/ico/law-lawyer-company-judge-512.webp">
</head>
<body>
<header>
    <nav class="nav">
        <a href="./index.html">
            <div class="nav-logo">
                <p>LawyeriaX</p>
                <p>Just another Demos Sites site</p>
            </div>
        </a>
        <div class="nav-menu">
            <a href="./index.html" ><p>Home</p></a>
            <a href="#"><p>Case Studies</p></a>
            <a href="#"><p>Careers</p></a>
            <a href="./blog.html"><p>Blog</p></a>
            <a class="current-page" href="contact.php"><p>Contact</p></a>
        </div>
    </nav>
</header>
<main>
<section class="contact-us-main">
    <div class="contact-us">
        <div class="contact-us-title">
            <h1>Contact</h1>
            <a href="./mymessages.php">My messages</a>
        </div>

        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur tellus ex, bibendum nec ligula nec,
            ornare facilisis massa. Etiam mattis orci a tortor laoreet, volutpat varius augue iaculis. Integer posuere
            ultricies ultrices. Proin ac mauris eu tortor imperdiet vehicula. Morbi porttitor fringilla metus et gravida.</p>

        <p>Ut sit amet mi erat. Mauris nunc tortor, aliquet at molestie in, varius sit amet libero. Morbi semper ipsum libero,
            ut maximus dui porta id. Pellentesque in est et lectus elementum varius. Ut egestas sapien id ipsum molestie pellentesque.
            Phasellus a magna orci. Vivamus eu urna vel magna cursus euismod vitae vulputate metus. Donec pellentesque ullamcorper
            vestibulum.</p>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div class ="name-and-email">
                <div class="name">
                    <label class="text-center" for="name">
                        Your Name</label>
                    <input placeholder="Type here" type="text" id="name" name="name" value="<?php echo $name; ?>" class="input-text"/>
                    <span class=" message error"><?php echo $msgName; ?></span>
                </div>

                <div class="email">
                    <label class="text-center" for="email">
                        Your Email</label>
                    <input placeholder="Type here" type="email" id="email" name="email" value="<?php echo $email; ?>" class="input-text"/>
                    <span class=" message error"><?php echo $msgEmail; ?></span>
                </div>
            </div>

            <div class="subject">
                <label class="text-center" for="subject">
                    Subject</label>
                <input placeholder="Type here" type="text" id="subject" name="subject" value="<?php echo $subject; ?>" class="input-text"/>
                <span class=" message error"><?php echo $msgSubject; ?></span>
            </div>

            <div class="message">
                <label class="text-center" for="message">
                    Your Message</label>
                <textarea placeholder="Type here..." name="message" id="message" rows="5" cols="40"><?php echo $message; ?></textarea>
                <span class="message error"><?php echo $msgMessage; ?></span>
            </div>

            <div class="submit">
                <div>
                    <button class="btn-primary" type="submit" id="btnSubmit" name="btnSubmit"value="Send me">
                        <span>Send Message</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="right-menu">
        <div class="search-bar">
            <label for="searchBar"></label>
            <input id="searchBar" name="searchBar" placeholder="Search ..." type="search">
            <button type="button" class="btn-primary">Search</button>
        </div>
        <div class="menu-list">
            <h1>Recent Post</h1>
            <div>
                <a href="./blog.html#banking-financial">Banking and Financial</a>
                <a href="./blog.html#family-law">Family Law</a>
                <a href="./blog.html#bicycle-accidents">Bicycle Accidents</a>
                <a href="./blog.html#car-accidents">Car Accidents</a>
                <a href="./blog.html#personal-injury-law">Personal Injury Lawyer</a>
            </div>

        </div>
        <div class="menu-list">
            <h1>Categories</h1>
            <div>
                <a href="#">Business Law</a>
                <a href="#">General Practice</a>
                <a href="#">Law</a>
                <a href="#">Meditation</a>
            </div>

        </div>
        <div class="menu-list">
            <h1>Pages</h1>
            <div>
                <a href="./blog.html" class="current-page">Blog</a>
                <a href="#">Careers</a>
                <a href="#">Case Studies</a>
                <a href="contact.php">Contact</a>
                <a href="./index.html">Front page</a>
            </div>

        </div>
    </div>
</section>
</main>
<footer>
    <div class="footer">
        <div class="contact">
            <h2>Contact</h2>
            <div class="info">
                <p>New York - 2 St. Lorem Ipsum</p>
                <div class="br"></div>
                <p>office@themeisle.com</p>
                <div class="br-s"></div>
                <p>(+4) 0746123456</p>
                <div class="br"></div>
                <div>
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M28.6895 22.2136L29.726 15.3883H23.242V10.9612C23.242 9.09345 24.1461 7.27184 27.0502 7.27184H30V1.46117C30 1.46117 27.3242 1 24.7671 1C19.4247 1 15.9361 4.26966 15.9361 10.1864V15.3883H10V22.2136H15.9361V38.7141C17.1279 38.9032 18.347 39 19.589 39C20.8311 39 22.0502 38.9032 23.242 38.7141V22.2136H28.6895Z" fill="#9f9c98"/>
                    </svg>
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M35.095 11.9679C35.1105 12.3199 35.1105 12.6559 35.1105 13.0079C35.1259 23.68 27.2851 36 12.9464 36C8.7173 36 4.56539 34.736 1 32.368C1.61738 32.448 2.23477 32.48 2.85215 32.48C6.35581 32.48 9.76686 31.264 12.5297 29.008C9.19578 28.944 6.2632 26.688 5.24452 23.392C6.41755 23.632 7.62145 23.584 8.76361 23.248C5.13647 22.512 2.52803 19.1999 2.51259 15.3439C2.51259 15.3119 2.51259 15.2799 2.51259 15.2479C3.59301 15.8719 4.81235 16.2239 6.04712 16.2559C2.63607 13.8879 1.57108 9.16791 3.63932 5.4719C7.60601 10.5279 13.4403 13.5839 19.7067 13.9199C19.0739 11.1199 19.9383 8.17591 21.9602 6.1919C25.0934 3.13589 30.0325 3.2959 32.9959 6.54391C34.7401 6.1919 36.4224 5.5199 37.9504 4.5759C37.3639 6.44791 36.1446 8.03191 34.524 9.03991C36.0674 8.84791 37.58 8.41591 39 7.77591C37.9504 9.40792 36.6231 10.8159 35.095 11.9679Z" fill="#9f9c98"/>
                    </svg>
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M39.2 20.4546C39.2 19.0364 39.0727 17.6727 38.8364 16.3636H20V24.1H30.7636C30.3 26.6 28.8909 28.7182 26.7727 30.1364V35.1546H33.2364C37.0182 31.6727 39.2 26.5455 39.2 20.4546Z" fill="#9f9c98"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M20 40C25.4 40 29.9273 38.2091 33.2364 35.1545L26.7727 30.1364C24.9818 31.3364 22.6909 32.0454 20 32.0454C14.7909 32.0454 10.3818 28.5273 8.80909 23.8H2.12727V28.9818C5.41818 35.5182 12.1818 40 20 40Z" fill="#9f9c98"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8.80909 23.8C8.40909 22.6 8.18182 21.3182 8.18182 20C8.18182 18.6818 8.40909 17.4 8.80909 16.2V11.0182H2.12727C0.772727 13.7182 0 16.7727 0 20C0 23.2273 0.772727 26.2818 2.12727 28.9818L8.80909 23.8Z" fill="#9f9c98"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M20 7.95455C22.9364 7.95455 25.5727 8.96364 27.6455 10.9455L33.3818 5.20909C29.9182 1.98182 25.3909 0 20 0C12.1818 0 5.41818 4.48182 2.12727 11.0182L8.80909 16.2C10.3818 11.4727 14.7909 7.95455 20 7.95455Z" fill="#9f9c98"/>
                    </svg>
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M37.0472 0H2.95278C2.16965 0 1.4186 0.311096 0.864849 0.864849C0.311096 1.4186 0 2.16965 0 2.95278V37.0472C0 37.8303 0.311096 38.5814 0.864849 39.1352C1.4186 39.6889 2.16965 40 2.95278 40H37.0472C37.8303 40 38.5814 39.6889 39.1352 39.1352C39.6889 38.5814 40 37.8303 40 37.0472V2.95278C40 2.16965 39.6889 1.4186 39.1352 0.864849C38.5814 0.311096 37.8303 0 37.0472 0ZM11.9222 34.075H5.90833V14.9722H11.9222V34.075ZM8.91111 12.325C8.22894 12.3212 7.56319 12.1153 6.99789 11.7335C6.43259 11.3516 5.99307 10.8109 5.7348 10.1795C5.47652 9.54808 5.41108 8.85432 5.54672 8.18576C5.68236 7.5172 6.013 6.90379 6.49693 6.42297C6.98085 5.94214 7.59636 5.61544 8.26578 5.4841C8.9352 5.35276 9.62852 5.42266 10.2583 5.68498C10.888 5.9473 11.4259 6.39028 11.8041 6.95802C12.1823 7.52576 12.3839 8.19282 12.3833 8.875C12.3898 9.33172 12.3042 9.78506 12.1317 10.208C11.9592 10.6309 11.7033 11.0148 11.3793 11.3368C11.0553 11.6587 10.6697 11.9121 10.2457 12.0819C9.82167 12.2517 9.36778 12.3344 8.91111 12.325ZM34.0889 34.0917H28.0778V23.6556C28.0778 20.5778 26.7694 19.6278 25.0806 19.6278C23.2972 19.6278 21.5472 20.9722 21.5472 23.7333V34.0917H15.5333V14.9861H21.3167V17.6333H21.3944C21.975 16.4583 24.0083 14.45 27.1111 14.45C30.4667 14.45 34.0917 16.4417 34.0917 22.275L34.0889 34.0917Z" fill="#9f9c98"/>
                    </svg>

                </div>
            </div>
        </div>
        <div class="sitemap">
            <h2>Sitemap</h2>
            <div class="info">
                <a href="./index.html" >Home</a>
                <a href="#">Case Studies</a>
                <a href="#">Careers</a>
                <a href="./blog.html">Blog</a>
                <a href="contact.php" class="current-page">Contact</a>
            </div>
        </div>
        <div class="recent">
            <h2>Recent Posts</h2>
            <div class="info">
                <a href="./blog.html#banking-financial">Banking and Financial</a>
                <a href="./blog.html#family-law">Family Law</a>
                <a href="./blog.html#bicycle-accidents">Bicycle Accidents</a>
                <a href="./blog.html#car-accidents">Car Accidents</a>
                <a href="./blog.html#personal-injury-law">Personal Injury Lawyer</a>
            </div>
        </div>

    </div>
    <div class="credits">
        <hr>
        <div class="br"></div>
        <p>Proudly powered by WordPress | Theme LawyeriaX by Themeisle</p>
    </div>
</footer>
</body>
</html>