package com.test.biblioteca.Controller;
import com.test.biblioteca.Entity.Clienti;
import com.test.biblioteca.Repository.ClientiRepo;
import com.test.biblioteca.Service.ClientiService;

import org.slf4j.LoggerFactory;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;
import lombok.extern.slf4j.Slf4j;
import jakarta.validation.Valid;
import java.util.Collection;
//import org.slf4j.Logger;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.server.ResponseStatusException;

@RestController
//@Slf4j
@RequestMapping("api/r1")
public class ClientiController {
  //  private Logger clientilogger ;
    private final ClientiService service;
    @Autowired
    private final ClientiRepo repository;

    public ClientiController(ClientiService service, ClientiRepo repository) {
     //   this.clientilogger = LoggerFactory.getLogger(ClientiController.class);
        this.service = service;
        this.repository = repository;
    }
    // CREATE = POST
    @RequestMapping(value ="/clienti", method = RequestMethod.POST)
    @ResponseStatus(HttpStatus.CREATED)
    public ResponseEntity<Clienti> addclienti(@Valid @RequestBody Clienti newclienti) {
        if (newclienti == null){
          //  clientilogger.error("richiesta creazione cliente");
            throw new ResponseStatusException(HttpStatus.BAD_REQUEST, "cliente non può essere nullo");
        }
        Clienti clienti = service.addclienti(newclienti);
        if (clienti == null) {
           // clientilogger.error("Errore server su richiesta");
            throw new ResponseStatusException(HttpStatus.INTERNAL_SERVER_ERROR, "impossibile creare cliente richiesto");
        }
       // clientilogger.trace("cliente creato con successo");
        return new ResponseEntity<>(clienti, HttpStatus.CREATED);
    }
    // READ = GET
    @RequestMapping(value = "clienti/{id}", method = RequestMethod.GET)
    public ResponseEntity<Clienti> getid(@PathVariable Long id) {
        if (id == null) {
            //clientilogger.error("rihiesta fallita");
            throw new ResponseStatusException(HttpStatus.BAD_REQUEST, "id non può essere nullo");
        }

        Clienti found = service.getid(id);
        if (found == null) {
           // clientilogger.error("i richiesto nullo");
            throw new ResponseStatusException(HttpStatus.NOT_FOUND, "non è possibile trovare cliente con questo id: " + id);
        }
      //  clientilogger.trace("richiesta con successo con questo  id{}", id);
        return new ResponseEntity<>(found, HttpStatus.OK);
    }
    @RequestMapping(method = RequestMethod.GET)
    public Collection<Clienti> getallclienti() {
        //clientilogger.trace("tutti i clienti");

        return repository.findAll();
    }
    // UPDATE = PUT
    @RequestMapping(value = "clienti/{id}", method = RequestMethod.PUT)
    @ResponseStatus(HttpStatus.NO_CONTENT)
    public ResponseEntity<Clienti> updateclienti(@PathVariable Long id, @RequestBody Clienti updateclienti) {
        if (id == null){
         //   clientilogger.error("richiesta di modifica nulla per questo id");
            throw new ResponseStatusException(HttpStatus.BAD_REQUEST, "Id nullo");

        }
        Clienti oldclienti = service.getid(id);
        if (oldclienti != null) {
            if(updateclienti.getNome() != null) oldclienti.setNome(updateclienti.getNome());
            if(updateclienti.getCognome() != null) oldclienti.setCognome(updateclienti.getCognome());
            if(updateclienti.getEmail() != null) oldclienti.setEmail(updateclienti.getEmail());
            if(updateclienti.getTelefono() != null) oldclienti.setTelefono(updateclienti.getTelefono());
            if(updateclienti.getData_nascita() != null) oldclienti.setData_nascita(updateclienti.getData_nascita());
            service.updateclienti(oldclienti);
           // clientilogger.trace("richiesta con successo per modificare questo id{}", id);
            return new ResponseEntity<>(updateclienti, HttpStatus.NO_CONTENT);
        } else {
        //    clientilogger.error("errore di richiesta id{}", id);
            throw new ResponseStatusException(HttpStatus.NOT_FOUND, "non è possibile trovare questo  id: " + id);
        }
    }
    // DELETE
    @DeleteMapping("clienti/{id}")
    @ResponseStatus(HttpStatus.NO_CONTENT)
    public ResponseEntity<String> deleteclienti(@PathVariable Long id){
        if (id == null){
          //  clientilogger.error("richiesta errore id{}", id);
            throw new ResponseStatusException(HttpStatus.BAD_REQUEST);
        }
       // clientilogger.trace("richiesta con successo per id {}", id);
        return new ResponseEntity<>(
                service.deleteclienti(id) ? "cliente con id" + id + "è stato elimanto con successo" : "Libro con id" + id + "non è stato eliminato",
                HttpStatus.NO_CONTENT
        );
    }
}

