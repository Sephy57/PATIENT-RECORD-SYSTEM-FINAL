-- Reconstructed schema for PredictiveCareHub — no dump existed in the repo,
-- so this was inferred from every query in the codebase. Adjust as needed
-- once you compare against the real production structure.

SET NAMES utf8mb4;

CREATE TABLE IF NOT EXISTS administrators (
    admin_id VARCHAR(36) NOT NULL PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    firstname VARCHAR(100) NOT NULL,
    lastname VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    user_type VARCHAR(20) NOT NULL, -- 'it' | 'him' | 'mrm'
    createdAt DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updatedAt DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS doctors (
    doctor_id VARCHAR(36) NOT NULL PRIMARY KEY,
    admin_id VARCHAR(36) NULL,
    username VARCHAR(100) NOT NULL UNIQUE,
    firstname VARCHAR(100) NOT NULL,
    lastname VARCHAR(100) NOT NULL,
    department VARCHAR(100) NULL,
    password VARCHAR(255) NOT NULL,
    user_type VARCHAR(20) NOT NULL DEFAULT 'doctor',
    createdAt DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updatedAt DATETIME NULL,
    CONSTRAINT fk_doctors_admin FOREIGN KEY (admin_id) REFERENCES administrators(admin_id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS patients (
    patient_id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(100) NOT NULL,
    lastname VARCHAR(100) NOT NULL,
    number VARCHAR(30) NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    birthday DATE NULL,
    age INT NULL,
    gender VARCHAR(20) NULL,
    address VARCHAR(255) NULL,
    password VARCHAR(255) NOT NULL,
    weight INT NULL,
    height INT NULL,
    bloodtype VARCHAR(5) NULL,
    signature VARCHAR(36) NOT NULL DEFAULT '-',
    user_type VARCHAR(20) NOT NULL DEFAULT 'patient',
    account_verified TINYINT(1) NOT NULL DEFAULT 0,
    createdAt DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updatedAt DATETIME NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS physicians (
    physician_id VARCHAR(36) NOT NULL PRIMARY KEY,
    admin_id VARCHAR(36) NULL,
    physician_name VARCHAR(150) NOT NULL,
    physician_role VARCHAR(100) NULL,
    physician_profile LONGBLOB NULL,
    createdAt DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updatedAt DATETIME NULL,
    CONSTRAINT fk_physicians_admin FOREIGN KEY (admin_id) REFERENCES administrators(admin_id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS services (
    service_id VARCHAR(36) NOT NULL PRIMARY KEY,
    admin_id VARCHAR(36) NULL,
    service_name VARCHAR(150) NOT NULL,
    description TEXT NULL,
    createdAt DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updatedAt DATETIME NULL,
    CONSTRAINT fk_services_admin FOREIGN KEY (admin_id) REFERENCES administrators(admin_id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS precaution_information (
    id VARCHAR(36) NOT NULL PRIMARY KEY,
    admin_id VARCHAR(36) NULL,
    title VARCHAR(150) NOT NULL,
    description TEXT NULL,
    createdAt DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updatedAt DATETIME NULL,
    CONSTRAINT fk_precaution_admin FOREIGN KEY (admin_id) REFERENCES administrators(admin_id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS predictive_information (
    id INT AUTO_INCREMENT PRIMARY KEY,
    admin_id VARCHAR(36) NULL,
    month INT NOT NULL,
    year INT NOT NULL,
    data LONGTEXT NOT NULL,
    selected TINYINT(1) NOT NULL DEFAULT 0,
    createdAt DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updatedAt DATETIME NULL,
    CONSTRAINT fk_predictive_admin FOREIGN KEY (admin_id) REFERENCES administrators(admin_id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS medical_records (
    id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    patient_name VARCHAR(150) NULL,
    request_type VARCHAR(150) NULL,
    doctor_id VARCHAR(36) NULL,
    doctor_name VARCHAR(150) NULL,
    document LONGBLOB NULL,
    prescription LONGBLOB NULL,
    seen TINYINT NOT NULL DEFAULT 0,
    uploaded TINYINT(1) NOT NULL DEFAULT 0,
    approved TINYINT(1) NOT NULL DEFAULT 0,
    archived TINYINT(1) NOT NULL DEFAULT 0,
    createdAt DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updatedAt DATETIME NULL,
    CONSTRAINT fk_medical_records_patient FOREIGN KEY (patient_id) REFERENCES patients(patient_id) ON DELETE CASCADE,
    CONSTRAINT fk_medical_records_doctor FOREIGN KEY (doctor_id) REFERENCES doctors(doctor_id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
