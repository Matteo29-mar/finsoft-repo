package com.stage.biblioteca.controller.clienti;

import com.stage.biblioteca.dto.clienti.ClientiDto;
import com.stage.biblioteca.entity.clienti.Clienti;
import com.stage.biblioteca.services.clienti.ClientiService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;
import java.util.Optional;

@RestController
@RequestMapping("/")
@CrossOrigin(origins = "*")
public class Clienticontroller {
    @Autowired
    ClientiService clientiService;
    //GET
    @GetMapping("api/cliente/getAll")
    public List<ClientiDto> getAll(){return clientiService.findClientiAll();}
   /* @GetMapping("api/cliente/getId")
    public List<ClientiDto> getId(@RequestParam Integer idCliente){return clientiService.findClientiById(idCliente);}*/

    //GET
    //con questo metodo stiamo cercando un solo elemento
    @GetMapping("api/cliente/getId{idCliente}")
    public ResponseEntity<ClientiDto> getId(@PathVariable("idCliente") Integer idCliente){
        ClientiDto cl = clientiService.findClientiId(idCliente);
        return ResponseEntity.status(HttpStatus.OK).body(cl);
    }
    //GET
    @GetMapping("api/cliente/getEmail")
    public ClientiDto getEmail(@RequestParam String email){return clientiService.findClientiByemail(email);}
    //POST
    @PostMapping("api/cliente/create")
    public ResponseEntity<ClientiDto> createNewCliente(@RequestBody ClientiDto clientiDto) {
        clientiService.createClienti(clientiDto);
        return ResponseEntity.status(HttpStatus.CREATED).body(clientiDto);
    }
    //PUT
    @PutMapping("api/cliente/update/{idCliente}")
    public ResponseEntity<ClientiDto> upCliente(@PathVariable("idCliente") Integer idCliente, @RequestBody ClientiDto clientiDto){
        ClientiDto res = clientiService.updateClienti(clientiDto, idCliente);
        return ResponseEntity.status(HttpStatus.OK).body(res);
    }
    //DELETE
    @DeleteMapping("api/cliente/delete{idCliente}")
    public void deleteCliente(@PathVariable("idCliente") Integer idCliente) {
        clientiService.deleteClientiId(idCliente);
    }

}
