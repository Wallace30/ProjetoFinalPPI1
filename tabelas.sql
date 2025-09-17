CREATE TABLE Funcionario (
    Codigo INT AUTO_INCREMENT PRIMARY KEY,
    Nome VARCHAR(100) NOT NULL,
    Email VARCHAR(100) NOT NULL UNIQUE,
    Senhahash VARCHAR(255) NOT NULL,
    EstadoCivil VARCHAR(20),
    DataNascimento DATE,
    Funcao VARCHAR(50)
);

CREATE TABLE Medico (
    Codigo INT AUTO_INCREMENT PRIMARY KEY,
    Nome VARCHAR(100) NOT NULL,
    Especialidade VARCHAR(50) NOT NULL,
    CRM VARCHAR(20) NOT NULL UNIQUE
);

CREATE TABLE Paciente (
    Codigo INT AUTO_INCREMENT PRIMARY KEY,
    Nome VARCHAR(100) NOT NULL,
    Sexo VARCHAR(10),
    Email VARCHAR(100),
    Telefone VARCHAR(20)
);

CREATE TABLE Agendamento (
    Codigo INT AUTO_INCREMENT PRIMARY KEY,
    Datahora DATETIME NOT NULL,
    CodigoMedico INT NOT NULL,
    CodigoPaciente INT NOT NULL,
    FOREIGN KEY (CodigoMedico) REFERENCES Medico(Codigo),
    FOREIGN KEY (CodigoPaciente) REFERENCES Paciente(Codigo)
);

CREATE TABLE Contato (
    Codigo INT AUTO_INCREMENT PRIMARY KEY,
    Nome VARCHAR(100) NOT NULL,
    Email VARCHAR(100),
    Telefone VARCHAR(20),
    Mensagem TEXT NOT NULL,
    Datahora TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE LoginInicial (
    Codigo INT PRIMARY KEY AUTO_INCREMENT,
    Usuario VARCHAR(50) NOT NULL UNIQUE,
    Senha VARCHAR(255) NOT NULL
);