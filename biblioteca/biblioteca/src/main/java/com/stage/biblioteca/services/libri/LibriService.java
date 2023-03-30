package com.stage.biblioteca.services.libri;

import com.stage.biblioteca.dto.libri.LibriDto;
import com.stage.biblioteca.entity.libri.Libri;
import com.stage.biblioteca.mapper.libri.LibriMapper;
import com.stage.biblioteca.repository.libri.LibriRepo;
import jakarta.persistence.EntityNotFoundException;
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
    public void  createLibro(LibriDto libroDto) {
        Libri libri = LibriMapper.INSTANCE.toEntity(libroDto);
        librirepo.save(libri);
    }


    //PUT
    public void updateLibro(Integer idLibro, LibriDto libriDto){
        Libri libri = librirepo.findById(idLibro).orElseThrow(() -> new EntityNotFoundException("libro non trovato con id " + idLibro));
        libri.setIsbn(libriDto.getIsbn());
        libri.setTitolo(libriDto.getTitolo());
        libri.setAutore(libriDto.getAutore());
        libri.setAnno(libriDto.getAnno());
        libri.setGenere(libriDto.getGenere());
        librirepo.save(libri);

    }

    //DELETE
    public void deleteBookId(Integer id) {
        Libri libri = librirepo.findById(id).orElseThrow(() -> new EntityNotFoundException("libro non trovato : " + id));
        librirepo.delete(libri);
    }

}


