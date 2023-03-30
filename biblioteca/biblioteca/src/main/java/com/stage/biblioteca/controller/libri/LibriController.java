package com.stage.biblioteca.controller.libri;
import com.stage.biblioteca.dto.libri.LibriDto;
import com.stage.biblioteca.entity.libri.Libri;
import com.stage.biblioteca.services.libri.LibriService;
import jakarta.validation.Valid;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@RequestMapping("/")
@CrossOrigin(origins = "*")
public class LibriController {
    @Autowired
    LibriService libriService;
    //GETALL
    @GetMapping("api/getAll")
    public List<LibriDto> getAll(){
        return libriService.findLibriAll();
    }
    //GET ISBN
   @GetMapping("api/getByIsbn")
   public List<LibriDto> getByIsbn(@RequestParam String isbn){
       return libriService.findLibriByIsbn(isbn);
   }

   //POST
    @PostMapping("api/create")
    public ResponseEntity<LibriDto> createNewLibro(@RequestBody LibriDto libroDto) {
        libriService.createLibro(libroDto);
        return ResponseEntity.status(HttpStatus.CREATED).body(libroDto);

    }
    //PUT
    @PutMapping("api/update")
    public ResponseEntity<String> updatedLibro(@PathVariable Integer idLibro, @RequestBody LibriDto libriDto) {
        libriService.updateLibro(idLibro, libriDto);
        return ResponseEntity.status(HttpStatus.OK).body("libro aggiornato");
    }

    //DELETE
    @DeleteMapping("api/delete")
    public ResponseEntity<String> deleteBook(@PathVariable Integer id) {
        libriService.deleteBookId(id);
        return ResponseEntity.status(HttpStatus.OK).body("libro eliminato");
    }

}
