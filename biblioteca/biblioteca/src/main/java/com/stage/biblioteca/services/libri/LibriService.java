package com.stage.biblioteca.services.libri;

import com.stage.biblioteca.dto.libri.LibriDto;
import com.stage.biblioteca.entity.libri.Libri;
import com.stage.biblioteca.mapper.libri.LibriMapper;
import com.stage.biblioteca.repository.libri.LibriRepo;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.ArrayList;
import java.util.List;


@Service
public class LibriService {

  @Autowired
    LibriRepo librirepo;

  //GET
    public List<LibriDto> findLibriAll(){

       List<LibriDto> responseFindAll =  new ArrayList<>();
        librirepo.findAll().forEach(libro -> {
            responseFindAll.add( LibriMapper.INSTANCE.todto(libro));

        });
/*        Libri ll =  librirepo.findById( Integer.decode("1")).get();*/
         return  responseFindAll;
    }

    //GET
    public List<LibriDto> findLibriByIsbn(String isbn) {
        List<LibriDto> responseFindByIsbn = new ArrayList<>();
        librirepo.findAll().forEach(libro -> {
            if (libro.getIsbn().equals(isbn)) {
                responseFindByIsbn.add(LibriMapper.INSTANCE.todto(libro));
            }
        });
        return responseFindByIsbn;
    }

    //POST
    public LibriDto createLibro(LibriDto libroDto) {
        Libri libro = LibriMapper.INSTANCE.toEntity(libroDto);
        libro = librirepo.save(libro);
        return LibriMapper.INSTANCE.todto(libro);
    }


    //PUT

    //DELETE
    public void deleteLibroById(Integer idLibro) {
        librirepo.deleteById(idLibro);
    }

}


