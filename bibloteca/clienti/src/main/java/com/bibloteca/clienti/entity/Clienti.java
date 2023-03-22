package com.bibloteca.clienti.entity;
import lombok.*;
import jakarta.persistence.*;
import jakarta.validation.constraints.NotEmpty;
import jakarta.validation.constraints.Size;
import java.time.LocalDate;
@Entity
@Table(name = "clienti")
@ToString

public class Clienti {
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long id_cliente;
    @Column(nullable = false)
    @NotEmpty

    private String nome;
    @Column(nullable = false)
    @NotEmpty(message = "nome must not be null")

    private String cognome;
    @Column(nullable = false)
    @NotEmpty(message = "cognome must not be null")

    private String email;
    @Column(nullable = false)
    @NotEmpty(message = "email must not be null")

    private String telefono;
    @Column(nullable = false)
    @NotEmpty(message = "telefono must not be null")

    private String data_nascita;

    public Clienti(Long id_cliente, String nome, String cognome, String email, String telefono, String data_nascita) {
        this.id_cliente = id_cliente;
        this.nome = nome;
        this.cognome = cognome;
        this.email = email;
        this.telefono = telefono;
        this.data_nascita = data_nascita ;
    }
    public Clienti(){

    }
    public Long getId_cliente() {
        return id_cliente;
    }

    public void setId_cliente(Long id_cliente) {
        this.id_cliente = id_cliente;
    }

    public String getNome() {
        return nome;
    }

    public void setNome(String nome) {
        this.nome = nome;
    }

    public String getCognome() {
        return cognome;
    }

    public void setCognome(String cognome) {
        this.cognome = cognome;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getTelefono() {
        return telefono;
    }

    public void setTelefono(String telefono) {
        this.telefono = telefono;
    }

    public String getData_nascita() {
        return data_nascita;
    }

    public void setData_nascita(String data_nascita) {
        this.data_nascita = data_nascita;
    }
}
