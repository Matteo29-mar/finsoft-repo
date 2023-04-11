package com.stage.biblioteca.mapper.prestiti;

import com.stage.biblioteca.dto.prestiti.PrestitiDto;
import com.stage.biblioteca.entity.prestiti.Prestiti;
import org.mapstruct.factory.Mappers;

public interface PrestitiMapper {
    public static final PrestitiMapper INSTANCE = Mappers.getMapper(PrestitiMapper.class);
    public Prestiti toEntity(PrestitiDto dto);

    public PrestitiDto toDto(Prestiti entity);
}
