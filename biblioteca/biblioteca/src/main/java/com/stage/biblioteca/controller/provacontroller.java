package com.stage.biblioteca.controller;
import org.springframework.context.annotation.ComponentScan;
import org.springframework.web.bind.annotation.CrossOrigin;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

@RestController
@RequestMapping("/")
@CrossOrigin(origins = "*")
public class provacontroller {

    @GetMapping("hello")
    public String ciaoProva(){
        return "ciao questa è una prova";
    }

}
