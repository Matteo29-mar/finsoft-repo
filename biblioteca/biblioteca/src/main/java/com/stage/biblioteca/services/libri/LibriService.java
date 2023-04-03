package com.stage.biblioteca.services.libri;

import com.stage.biblioteca.dto.libri.LibriDto;
import com.stage.biblioteca.entity.libri.Libri;
import com.stage.biblioteca.mapper.libri.LibriMapper;
import com.stage.biblioteca.repository.libri.LibriRepo;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.ArrayList;
import java.util.List;
import java.util.concurrent.atomic.AtomicReference;

//@autowired =serve per inniettare un'istanza all'interno della classe corrente
//@service = componente di servizio dell'app
//nel service è la logica che sta dietro alle funzionalità dell'applicazione
@Service
public class LibriService {
  @Autowired
    LibriRepo librirepo;
  //GET= getall qua riporta tutti i libri tramite una lista che trova con il metodo findall
  //tutti i libri dentro al repo
    public List<LibriDto> findLibriAll(){
       List<LibriDto> responseFindAll =  new ArrayList<>();
        librirepo.findAll().forEach(libro -> {
            responseFindAll.add( LibriMapper.INSTANCE.todto(libro));
        });
/*        Libri ll =  librirepo.findById( Integer.decode("1")).get();*/
         return  responseFindAll;
    }
    //GET  = getisbn ha lo stesso funzionalità del get all solo che cerca isbn
    //responseFindbyisbn servono per contenere i libri trovati, il repo serve per
    //trovare i libri e poi fa il foreach per cercare isbn del repository utilizzando la funzione
    // todo del mapper aggiungendo all'attributo
    public List<LibriDto> findLibriByIsbn(String isbn) {
        List<LibriDto> responseFindByIsbn = new ArrayList<>();
        librirepo.findAll().forEach(libro -> {
            if (libro.getIsbn().equals(isbn)) {
                responseFindByIsbn.add(LibriMapper.INSTANCE.todto(libro));
            }
        });
        return responseFindByIsbn;
    }

    //POST = post creazione di un nuovo libro, utilizzando il mapper per convertire l'oggetto
    //libridto all'oggetto libri per salvarlo nel repository
    public void  createLibro(LibriDto libroDto) {
        Libri libri = LibriMapper.INSTANCE.toEntity(libroDto);
        librirepo.save(libri);
    }
 

    //PUT = update
    public LibriDto updateLibro(LibriDto libriDto, Integer idLibro){
    AtomicReference<LibriDto> response = new AtomicReference<>(new LibriDto());
    librirepo.findAll().forEach(putLibro -> {
        if(putLibro.getIdLibro().intValue() == idLibro.intValue() ){


            putLibro.setIsbn(libriDto.getIsbn());
            putLibro.setTitolo(libriDto.getTitolo());
            putLibro.setAutore(libriDto.getAutore());
            putLibro.setAnno(libriDto.getAnno());
            putLibro.setGenere(libriDto.getGenere());
            putLibro = librirepo.save(putLibro);
            response.set(LibriMapper.INSTANCE.todto(putLibro));
        }
    });
    return response.get();
    }

    //DELETE = delete
    public void deleteBookId(Integer idLibro) {
        librirepo.deleteById(idLibro);
    }
    
}


