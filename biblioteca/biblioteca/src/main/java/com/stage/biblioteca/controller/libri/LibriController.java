package com.stage.biblioteca.controller.libri;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("/")
@CrossOrigin(origins = "*")
public class LibriController {
    @GetMapping("api/getall")
    public String get_all(){return "sei nel get all";}

    @GetMapping("api/getisbn")
    public String get_isbn(){return "sei nel get isbn";}

    @PostMapping("api/create")
    public String post_libro(){return "sei nel post create nuovo libro";}

    @PutMapping("api/update")
    public String put_libro(){return "sei nel update del libro ";}

    @DeleteMapping("api/delete")
    public String delete_libro(){return "sei nel delete del libro";}
}
