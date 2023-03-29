package com.stage.biblioteca.controller.libri;
import com.stage.biblioteca.dto.libri.LibriDto;
import com.stage.biblioteca.services.libri.LibriService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@RequestMapping("/")
@CrossOrigin(origins = "*")
public class LibriController {
    @Autowired
    LibriService libriService;
    @GetMapping("api/getAll")
    public List<LibriDto> getAll(){
        return libriService.findLibriAll();
    }

    @GetMapping("api/getIsbn")
    public String getIsbn(){
        return "new LibriDto()";
    }

    @PostMapping("api/create")
    public String post_libro(){return "sei nel post create nuovo libro";}

    @PutMapping("api/update")
    public String put_libro(){return "sei nel update del libro ";}

    @DeleteMapping("api/delete")
    public String delete_libro(){return "sei nel delete del libro";}
}
