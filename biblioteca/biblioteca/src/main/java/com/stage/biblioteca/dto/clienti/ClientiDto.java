package com.stage.biblioteca.dto.clienti;


import com.fasterxml.jackson.annotation.JsonInclude;
import com.stage.biblioteca.entity.prestiti.Prestiti;
import java.io.Serializable;
import java.util.List;

import jakarta.validation.Valid;
import lombok.Data;
@Data
@JsonInclude(value = JsonInclude.Include.NON_NULL)
public class ClientiDto {
    private Integer idCliente;
    private String nome;
    private String cognome;
    private String email;
    private String telefono;
    private String dataNascita;
    private List<Prestiti> prestitiList;

}
