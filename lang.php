<?php
//lang
$lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '  ';
if(substr($lang, 0 ,2)!="de"){
        $_SESSION['lang'] = "en";
}
else{
        $_SESSION['lang'] = "de";
}

//AI used for translation here - English is neither my main nor my first language

//*   INDEX
$lngwelcometext1 = [
'de' => "Hier bist du genau richtig",
'en' => "You are exactly where you are supposed to be!"
];
$lngwelcometext2 = [
    'de' => "Denn Geld ist unser Ding",
    'en' => "'Cause money is our thing"
    ];
$lnglogin = [
    'de' => "Anmelden",
    'en' =>  "Login"
    ];
$lngnewaccount = [
    'de' =>  "Registrieren",
    'en' =>  "New Account"
    ];
$lngLegalDisclosure = [
    'de' =>  "Impressum",
    'en' =>  "Legal Disclosure"
    ];
$lngwhoweare = [
    'de' =>  "Wer sind wir?",
    'en' =>  "Who we are"
];
//*   login
$lngAnmeldenTitle = [
    'de' => "Anmelden",
    'en' => "Login"
];
$lngAnmeldenH1 = [
    'de' => "Melden Sie sich bitte an",
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
    'de' => "Wir sind eine digitale Bank. Vertrauen Sie uns Ihr Geld sicher an - wir bieten besondere Möglichkeiten!",
    'en' => "We are a digital bank. Trust us with your money securely - we offer special possibilities!"
];
//      dashboard
$lngDashboardTitle = [
    'de' => "Dashboard",
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
    'de' => "Überweisungen",
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
    'de' => "E-Mail-Adresse des Empfängers",
    'en' => "Recipient e-mail"
];
$lngTransferPlaceholderMenge = [
    'de' => "Betrag",
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
    'en' => "You cannot transfer money to yourself!"
];
$lngTransferErrorAllgemein = [
    'de' => "Fehler!",
    'en' => "Error!"
];
$lngTransferFooterDashboard = [
    'de' => "Zurück zum Dashboard",
    'en' => "Back to dashboard"
];