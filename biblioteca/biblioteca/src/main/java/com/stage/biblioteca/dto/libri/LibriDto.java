package com.stage.biblioteca.dto;

import com.fasterxml.jackson.annotation.JsonInclude;
import com.stage.biblioteca.entity.prestiti.Prestiti;
import java.io.Serializable;
import java.util.List;

import jakarta.persistence.Basic;
import jakarta.persistence.CascadeType;
import jakarta.persistence.Column;
import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.OneToMany;
import jakarta.persistence.Table;
import lombok.Data;

@Entity
@Data
@JsonInclude(value = JsonInclude.Include.NON_NULL)
@Table(name = "libri")
public class LibriDto implements Serializable {

    private static final long serialVersionUID = 1L;
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Basic(optional = false)
    @Column(name = "id_libro")
    private Integer idLibro;
    @Basic(optional = false)
    @Column(name = "isbn")
    private String isbn;
    @Basic(optional = false)
    @Column(name = "titolo")
    private String titolo;
    @Basic(optional = false)
    @Column(name = "autore")
    private String autore;
    @Basic(optional = false)
    @Column(name = "anno")
    private String anno;
    @Basic(optional = false)
    @Column(name = "genere")
    private String genere;
    @OneToMany(cascade = CascadeType.ALL, mappedBy = "idLibro")
    private List<Prestiti> prestitiList;
}