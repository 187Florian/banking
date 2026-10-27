<?php
//lang
$lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '  ';
if(substr($lang, 0 ,2)!="de"){
        $_SESSION['lang'] = "en";
}
else{
        $_SESSION['lang'] = "de";
}

//AI used for translation here - english is not my main nor first language

//*   INDEX
$lngwelcometext1 = [
'de' => "Hier bist du genau Richtig",
'en' => "You are exacy were you are supposed to be!"
];
$lngwelcometext2 = [
    'de' => "Denn Geld ist unser Ding",
    'en' => "'Cause money is our think"
    ];
$lnglogin = [
    'de' => "Anmelden",
    'en' =>  "Login"
    ];
$lngnewaccount = [
    'de' =>  "Regestrieren",
    'en' =>  "New Account"
    ];
$lngLegalDisclosure = [
    'de' =>  "Impressum",
    'en' =>  "Legal Disclosure"
    ];
$lngwhoweare = [
    'de' =>  "Wer sind wir",
    'en' =>  "Who we are"
];
//*   login
$lngAnmeldenTitle = [
    'de' => "Anmelden",
    'en' => "Login"
];
$lngAnmeldenH1 = [
    'de' => "Melden sie sich bitte an",
    'en' => "Please log in"
];
$lngAnmeldenPlaceholderEmail = [
    'de' => "E-Mail",
    'en' => "E-mail"
];
$lngAnmeldenPlaceholderPassword = [
    'de' => "Passwort",
    'en' => "Password"
];
$lngAnmeldenButton = [
    'de' => "Anmelden",
    'en' => "Login"
];
$lngAnmeldenFooterNoAccount = [
    'de' => "Noch kein Konto: Registrieren",
    'en' => "No account yet: Register"
];
$lngZurueckHauptseite = [
    'de' => "Zurück zur Hauptseite",
    'en' => "Back to home page"
];
// new ACC
$lngRegistrierenTitle = [
    'de' => "Registrieren",
    'en' => "Register"
];
$lngRegistrierenH1 = [
    'de' => "Konto erstellen",
    'en' => "Create account"
];
$lngRegistrierenPlaceholderEmail = [
    'de' => "Gültige E-Mail",
    'en' => "Valid e-mail"
];
$lngRegistrierenPlaceholderPassword = [
    'de' => "Sicheres Passwort",
    'en' => "Secure password"
];
$lngRegistrierenButton = [
    'de' => "Registrieren",
    'en' => "Register"
];
$lngRegistrierenError = [
    'de' => "Fehler!",
    'en' => "Error!"
];
$lngRegistrierenErrorValidInfo = [
    'de' => "Bitte gültige Daten angeben!",
    'en' => "Please provide valid info!"
];
$lngRegistrierenFooterHaveAccount = [
    'de' => "Sie besitzen schon ein Konto?",
    'en' => "Do you already have an account?"
];

//Impressum
$lngImpressumTitle = [
    'de' => "Impressum",
    'en' => "Legal Disclosure"
];
$lngImpressumH1 = [
    'de' => "Impressum",
    'en' => "Legal Disclosure"
];
$lngImpressumH2 = [
    'de' => "Wer bin ich?",
    'en' => "Who am I?"
];
$lngImpressumText = [
    'de' => "Mein Name ist Walter Hartwell White. Ich wohne in der 308 Negra Arroyo Lane, Albuquerque, New Mexico, 87104. An alle Strafverfolgungsbehörden: Dies ist kein Schuldeingeständnis.",
    'en' => "My name is Walter Hartwell White. I live at 308 Negra Arroyo Lane, Albuquerque, New Mexico, 87104. To all law enforcement entities: This is not a confession of guilt."
];
// Who we are
$lngExplainTitle = [
    'de' => "Erklärung",
    'en' => "Explanation"
];
$lngExplainH1 = [
    'de' => "Was sind wir?",
    'en' => "What are we?"
];
$lngExplainText = [
    'de' => "Wir sind eine Digitale Bank. Vertrauen sie uns ihr Geld sicher an - wir bieten besonder Möglichekeiten!",
    'en' => "We are a digital bank. Trust us with your money securely - we offer special possibilities!"
];
//      dashbaord
$lngDashboardTitle = [
    'de' => "Dashbaord",
    'en' => "Dashboard"
];
$lngDashboardH1 = [
    'de' => "Dashboard",
    'en' => "Dashboard"
];
$lngDashboardAbmelden = [
    'de' => "Abmelden",
    'en' => "Log out"
];
$lngDashboardWillkommen = [
    'de' => "Willkommen",
    'en' => "Welcome"
];
$lngDashboardKontostand = [
    'de' => "Dein Kontostand beträgt: ",
    'en' => "Your balance is: "
];
$lngDashboardUeberweisungen = [
    'de' => "Überweisungen",
    'en' => "Transfers"
];
//      transfers
$lngTransferTitle = [
    'de' => "Überweisung",
    'en' => "Transfer"
];
$lngTransferH1 = [
    'de' => "Überwesungen",
    'en' => "Transfers"
];
$lngTransferAvailable1 = [
    'de' => "Sie können ",
    'en' => "You can transfer "
];
$lngTransferAvailable2 = [
    'de' => "€ überweisen",
    'en' => "€"
];
$lngTransferPlaceholderMail = [
    'de' => "Empfänger Email",
    'en' => "Recipient e-mail"
];
$lngTransferPlaceholderMenge = [
    'de' => "Menge",
    'en' => "Amount"
];
$lngTransferButton = [
    'de' => "Überweisen",
    'en' => "Transfer"
];
$lngTransferErfolg = [
    'de' => "Erfolg",
    'en' => "Success"
];
$lngTransferError = [
    'de' => "Fehler!",
    'en' => "Error!"
];
$lngTransferErrorSelf = [
    'de' => "Du kannst dir nicht selbst Geld überweisen!",
    'en' => "You can not transfer yourself money!"
];
$lngTransferErrorAllgemein = [
    'de' => "Fehler!",
    'en' => "error!"
];
$lngTransferFooterDashboard = [
    'de' => "Zurück zum Dashbaord",
    'en' => "Back to dashboard"
];