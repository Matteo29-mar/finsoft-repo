package com.stage.biblioteca.controller.libri;

import com.stage.biblioteca.dto.libri.LibriDto;
import com.stage.biblioteca.services.libri.LibriService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;
import java.util.List;

//@restcontroller = restituisce un controller restful, @requestmapping = url di base deel controller, @crossorigin = permettere di accedere alle risorse del controller da ogni parte

@RestController
@RequestMapping("/")
@CrossOrigin(origins = "*")
public class LibriController {
    @Autowired
    LibriService libriService;

    // GETALL = lista del istanza dto e ritorna il valore del service e il meotdo fatto nel service
    @GetMapping("api/libro/getAll")
    public List<LibriDto> getAll() {
        return libriService.findLibriAll();
    }

    // GET ISBN

    //@requestparam per recuperare stringhe da una richiesta http in get, serve per recupare un valore come stringa
    @GetMapping("api/libro/getByIsbn")
    public LibriDto getByIsbn(@RequestParam String isbn) {
        return libriService.findLibriIsbn(isbn);
    }

    // POST
    // @requestbody viene utlizzzato per recuperare un corpo da una richiesta http da post, in genere per recuperare un oggetto in json
    @PostMapping("api/libro/create")
    public ResponseEntity<LibriDto> createNewLibro(@RequestBody LibriDto libroDto) {
        libriService.createLibro(libroDto);
        return ResponseEntity.status(HttpStatus.CREATED).body(libroDto);
    }

    // PUT
    //@pathvariabile = recupera una parte dell url come parametro
    @PutMapping("api/libro/update{idLibro}")
    public ResponseEntity<LibriDto> upLibro(@PathVariable("idLibro") Integer idLibro, @RequestBody LibriDto libriDto) {
        LibriDto res = libriService.updateLibro(libriDto, idLibro);
        return ResponseEntity.status(HttpStatus.OK).body(res);
    }

    // DELETE
    @DeleteMapping("api/libro/delete{idLibro}")
    public void deleteLibro(@PathVariable("idLibro") Integer idLibro) {
        libriService.deleteBookId(idLibro);
    }

}
