package com.stage.biblioteca.dto.libri;

import com.fasterxml.jackson.annotation.JsonInclude;
import com.stage.biblioteca.entity.prestiti.Prestiti;
import java.io.Serializable;
import java.util.List;

import jakarta.validation.Valid;
import lombok.Data;

//@Jsoninclude = qui vengono riportati dei json
//il dto serve come comunicatore tra il front end e tutti il layer dell'app tutte le funzioni si dovranno riportare con lui
@Data
@JsonInclude(value = JsonInclude.Include.NON_NULL)

public class LibriDto implements Serializable {

    private Integer idLibro;
    private String isbn;
    private String titolo;
    private String autore;
    private String anno;
    private String genere;
    private List<Prestiti> prestitiList;
}