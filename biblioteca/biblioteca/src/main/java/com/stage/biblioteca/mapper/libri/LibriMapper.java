package com.stage.biblioteca.mapper.libri;

import com.stage.biblioteca.dto.libri.LibriDto;
import com.stage.biblioteca.entity.libri.Libri;
import org.mapstruct.Mapper;

import org.mapstruct.factory.Mappers;

@Mapper
public interface LibriMapper {

    public static final LibriMapper INSTANCE = Mappers.getMapper(LibriMapper.class);
    public Libri toEntity(LibriDto dto);

    public LibriDto todto(Libri entity);
}
