package com.stage.biblioteca.services.libri;
import com.stage.biblioteca.dto.libri.LibriDto;
import com.stage.biblioteca.entity.libri.Libri;
import com.stage.biblioteca.mapper.libri.LibriMapper;
import com.stage.biblioteca.repository.libri.LibriRepo;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import java.util.ArrayList;
import java.util.List;
import java.util.Optional;
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
    public List<LibriDto> findLibriAll() {
        List<LibriDto> responseFindAll = new ArrayList<>();
        librirepo.findAll().forEach(libro -> {
            responseFindAll.add(LibriMapper.INSTANCE.todto(libro));
        });
        /*        Libri ll =  librirepo.findById( Integer.decode("1")).get();*/
        return responseFindAll;
    }
    //GET  = getisbn ha lo stesso funzionalità del get all solo che cerca isbn
    //responseFindbyisbn servono per contenere i libri trovati, il repo serve per
    //trovare i libri e poi fa il foreach per cercare isbn del repository utilizzando la funzione
    // todo del mapper aggiungendo all'attributo
    public LibriDto findLibriIsbn(String isbn){
        Optional<Libri> opt = librirepo.findByIsbn(isbn);
        LibriDto libriDto = new LibriDto();
        if(opt.isPresent()){
            libriDto = LibriMapper.INSTANCE.todto(opt.get());
        }
        return libriDto;
    }
    //POST = post creazione di un nuovo libro, utilizzando il mapper per convertire l'oggetto
    //libridto all'oggetto libri per salvarlo nel repository
    public void createLibro(LibriDto libroDto) {
        Libri libri = LibriMapper.INSTANCE.toEntity(libroDto);
        librirepo.save(libri);
    }
    //PUT = update
    public LibriDto updateLibro(LibriDto libriDto, Integer idLibro) {
        //atomicrefernce è una classe che serve per mantenere riferimento ad
        // un oggetto in modo indivisibile e non che si possa interrompere
        AtomicReference<LibriDto> response = new AtomicReference<>(new LibriDto());
        //(parametri) -> espression, questa è una lmabda servono per creare funzioni
        // compatte senza creare una classe separata per ogni caso d'uso
        librirepo.findAll().forEach(putLibro -> {
            //in questa selezione controliamo che quello che gli stiamo passando sia un
            // int con intvalue se passa modifica il resto
            if (putLibro.getIdLibro().intValue() == idLibro.intValue()) {
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
        Optional<Libri> opt =  librirepo.findById(idLibro);
        if(opt.isPresent()){
            librirepo.delete(opt.get());
        } else {
            throw new RuntimeException("risorsa non trovata impossibile cancellare");
        }
        /*librirepo.deleteById(idLibro);*/
    }
}


