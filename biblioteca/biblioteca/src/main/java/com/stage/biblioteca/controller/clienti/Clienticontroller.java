package com.stage.biblioteca.controller.clienti;

import com.stage.biblioteca.dto.clienti.ClientiDto;
import com.stage.biblioteca.repository.clienti.ClientiRepo;
import com.stage.biblioteca.services.clienti.ClientiService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@RequestMapping("/")
@CrossOrigin(origins = "*")
public class Clienticontroller {
    @Autowired
    ClientiService clientiService;

    @GetMapping("api/cliente/getAll")
    public List<ClientiDto> getAll(){return clientiService.findClientiAll();}
    @GetMapping("api/cliente/getEmail")
    public List<ClientiDto> getEmail(@RequestParam String email){return clientiService.findClientiByEmail(email);}
    @PostMapping("api/cliente/create")
    public String postCliente(){return "sei nel post create nuovo cliente";}
    @PutMapping("api/cliente/update")
    public String putCliente(){return "sei nel update del cliente ";}
    @DeleteMapping("api/cliente/delete")
    public String deleteCliente(){return "sei nel delete del cliente";}
}
