agent-contrib
=============

Conrtibutor License Agreement system

License
=======
AGPL v3 []

Features
========
* Display CLA contract and a form that allows the user to sign it using the mouse to draw the signature
* Record user info and signature in DB
* Send a PDF or HTML email with the contract, contributor's info and an SVG of the user's signature to the contributor and a configurable list of additional recipients
* Optional intrgration with Marketo which allows sending the contributor's info as lead

Requirements
============
- Web server with PHP support
- SQLite3
- SQLite3 PHP extension
- An MTA

Bundled third party software
============================
* FlashCanvas
* SignaturePad [http://thomasjbradley.ca/lab/signature-pad]
* SigToSvg [http://thomasjbradley.ca/lab/signature-pad]
* PHPMailer [https://github.com/PHPMailer/PHPMailer/]
