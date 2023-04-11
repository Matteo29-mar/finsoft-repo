package com.stage.biblioteca.dto.prestiti;

import java.io.Serializable;

import com.fasterxml.jackson.annotation.JsonInclude;
import com.stage.biblioteca.entity.clienti.Clienti;
import com.stage.biblioteca.entity.libri.Libri;
import jakarta.persistence.*;
import  lombok.Data;
@Data
@JsonInclude(value = JsonInclude.Include.NON_NULL)
public class PrestitiDto implements Serializable {
    private Integer idPrestito;
    private String dataInizio;
    private String dataFine;
    private String dataConsegna;
    private Clienti idCliente;
    private Libri idLibro;

}
