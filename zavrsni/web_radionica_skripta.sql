CREATE DATABASE web_radionica;

USE web_radionica;

CREATE TABLE Radnici (
    OIB CHAR(11) not null PRIMARY KEY,
    Ime VARCHAR(255),
	Prezime VARCHAR(255),
    CijenaSata DECIMAL(10, 2),
    KontaktInfo VARCHAR(255)
);

CREATE TABLE Klijenti (
    IDKlijenta INT not null PRIMARY KEY AUTO_INCREMENT,
    Ime VARCHAR(255),
	Prezime VARCHAR(255),
    KontaktInfo VARCHAR(255)
);

CREATE TABLE RadniNalozi (
    IDRadnogNaloga INT not null PRIMARY KEY AUTO_INCREMENT,
    IDRadnika CHAR(11),
    IDKlijenta INT,
    DatumOtvaranja DATE,
    OpisPopravka TEXT,
    UtvrdeniKvar TEXT,
    DatumZatvaranja DATE,
    UkupnoVrijemePopravka DECIMAL(10, 2),
    CijenaDijelova DECIMAL(10, 2),
    CijenaRada DECIMAL(10, 2),
    FOREIGN KEY (IDRadnika) REFERENCES Radnici(OIB),
    FOREIGN KEY (IDKlijenta) REFERENCES Klijenti(IDKlijenta)
);
