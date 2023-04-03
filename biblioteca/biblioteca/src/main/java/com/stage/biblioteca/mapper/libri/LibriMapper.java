package com.stage.biblioteca.mapper.libri;

import com.stage.biblioteca.dto.libri.LibriDto;
import com.stage.biblioteca.entity.libri.Libri;
import org.mapstruct.Mapper;

import org.mapstruct.factory.Mappers;

/*@mapper= serve per mappare i "percorsi", tra entity e dto ed viceversa, lo facciamo per non
 esporre l'entity davanti ed usare il dto per ricevere i dati*/
@Mapper
public interface LibriMapper {

    //crea un'istanza, instance serve per accedere all'istanza del mapper ed utilizzarla
    public static final LibriMapper INSTANCE = Mappers.getMapper(LibriMapper.class);

    //definisce un metodo che riceve dto e lo converte in entity quella sotto il contrario
    public Libri toEntity(LibriDto dto);

    public LibriDto todto(Libri entity);
}
