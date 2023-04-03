package com.stage.biblioteca.mapper.clienti;

import com.stage.biblioteca.dto.clienti.ClientiDto;
import com.stage.biblioteca.entity.clienti.Clienti;
import org.mapstruct.Mapper;
import org.mapstruct.factory.Mappers;

@Mapper
public interface ClientiMapper {
    public static final ClientiMapper INSTANCE = Mappers.getMapper(ClientiMapper.class);
    public Clienti toEntity(ClientiDto dto);

    public ClientiDto todto(Clienti entity);
}
