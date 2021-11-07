
<body>
    <?php
    # Avtorizirani uporabniki (to navadno pride iz podatkovne baze)
    $authorized_users = ["Ana"];

 
    $client_cert = filter_input(INPUT_SERVER, "SSL_CLIENT_CERT");


    $cert_data = openssl_x509_parse($client_cert);


    $commonname = $cert_data['subject']['CN'];

    if (in_array($commonname, $authorized_users)) {
        phpinfo(-1);
    } else {
    # Sicer časa ne prikažemo.
        echo "$commonname ni avtoriziran uporabnik";
    }
    ?>
</body>
