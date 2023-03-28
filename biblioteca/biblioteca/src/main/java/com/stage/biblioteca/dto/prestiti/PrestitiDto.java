package com.stage.biblioteca.dto;

import java.io.Serializable;

import com.fasterxml.jackson.annotation.JsonInclude;
import com.stage.biblioteca.entity.libri.Libri;
import com.stage.biblioteca.entity.clienti.Clienti;
import jakarta.persistence.Basic;
import jakarta.persistence.Column;
import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.JoinColumn;
import jakarta.persistence.ManyToOne;
import jakarta.persistence.NamedQueries;
import jakarta.persistence.NamedQuery;
import jakarta.persistence.Table;
import lombok.Data;

@Entity
@Data
@JsonInclude(value = JsonInclude.Include.NON_NULL)
@Table(name = "prestiti")
public class PrestitiDto implements Serializable {

    private static final long serialVersionUID = 1L;
    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    @Basic(optional = false)
    @Column(name = "id_prestito")
    private Integer idPrestito;
    @Basic(optional = false)
    @Column(name = "data_inizio")
    private int dataInizio;
    @Basic(optional = false)
    @Column(name = "data_fine")
    private int dataFine;
    @Basic(optional = false)
    @Column(name = "data_consegna")
    private int dataConsegna;
    @JoinColumn(name = "id_cliente", referencedColumnName = "id_cliente")
    @ManyToOne(optional = false)
    private Clienti idCliente;
    @JoinColumn(name = "id_libro", referencedColumnName = "id_libro")
    @ManyToOne(optional = false)
    private Libri idLibro;

}
