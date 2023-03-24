package com.bibloteca.clienti.controller;
import com.bibloteca.clienti.entity.Clienti;
import com.bibloteca.clienti.repository.Clientirepository;
import com.bibloteca.clienti.service.Clientiservice;
import org.slf4j.LoggerFactory;
import org.springframework.beans.CachedIntrospectionResults;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;
import lombok.extern.slf4j.Slf4j;
import jakarta.validation.Valid;
import java.util.Collection;
import org.slf4j.Logger;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.server.ResponseStatusException;

@RestController
@Slf4j
@RequestMapping("api/r1")
public class Clienticontroller {
    private Logger clientilogger ;

    private final Clientiservice service;
    @Autowired
    private final Clientirepository repository;

    public Clienticontroller(Logger clientilogger,Clientiservice service, Clientirepository repository) {
        this.clientilogger = LoggerFactory.getLogger(Clienticontroller.class);
        this.service = service;
        this.repository = repository;
    }
    // CREATE = POST
    @RequestMapping(value ="/clienti", method = RequestMethod.POST)
    @ResponseStatus(HttpStatus.CREATED)
    public ResponseEntity<Clienti> AddClienti(@Valid @RequestBody Clienti NewClienti) {
        if (NewClienti == null){
            clientilogger.error("richiesta creazione cliente");
            throw new ResponseStatusException(HttpStatus.BAD_REQUEST, "cliente non può essere nullo");
        }
        Clienti clienti = service.AddClienti(NewClienti);
        if (clienti == null) {
            clientilogger.error("Errore server su richiesta");
            throw new ResponseStatusException(HttpStatus.INTERNAL_SERVER_ERROR, "impossibile creare cliente richiesto");
        }
        clientilogger.trace("cliente creato con successo");
        return new ResponseEntity<>(clienti, HttpStatus.CREATED);
    }
    // READ = GET
    @RequestMapping(value = "/{id}", method = RequestMethod.GET)
    public ResponseEntity<Clienti> GetId(@PathVariable Long id) {
        if (id == null) {
            clientilogger.error("rihiesta fallita");
            throw new ResponseStatusException(HttpStatus.BAD_REQUEST, "id non può essere nullo");
        }

        Clienti found = service.GetId(id);
        if (found == null) {
            clientilogger.error("i richiesto nullo");
            throw new ResponseStatusException(HttpStatus.NOT_FOUND, "non è possibile trovare cliente con questo id: " + id);
        }
        clientilogger.trace("richiesta con successo con questo  id{}", id);
        return new ResponseEntity<>(found, HttpStatus.OK);
    }
    @RequestMapping(method = RequestMethod.GET)
    public Collection<Clienti> GetAllClienti() {
        clientilogger.trace("tutti i clienti");
        log.info("ottieni tutti i clienti");
        return repository.findAll();
    }
    // UPDATE = PUT
    @RequestMapping(value = "/{id_cliente}", method = RequestMethod.PUT)
    @ResponseStatus(HttpStatus.NO_CONTENT)
    public ResponseEntity<Clienti> Update_Clienti(@PathVariable Long id_cliente, @RequestBody Clienti UpdateClienti) {
        if (id_cliente == null){
            clientilogger.error("richiesta di modifica nulla per questo id");
            throw new ResponseStatusException(HttpStatus.BAD_REQUEST, "Id nullo");

        }
0        Clienti oldClienti = service.GetId(id_cliente);
        if (oldClienti != null) {
            if(UpdateClienti.getNome() != null) oldClienti.setNome(UpdateClienti.getNome());
            if(UpdateClienti.getCognome() != null) oldClienti.setCognome(UpdateClienti.getCognome());
            if(UpdateClienti.getEmail() != null) oldClienti.setEmail(UpdateClienti.getEmail());
            if(UpdateClienti.getTelefono() != null) oldClienti.setTelefono(UpdateClienti.getTelefono());
            if(UpdateClienti.getData_nascita() != null) oldClienti.setData_nascita(UpdateClienti.getData_nascita());
            service.Update_Clienti(oldClienti);
            clientilogger.trace("richiesta con successo per modificare questo id{}", id_cliente);
            return new ResponseEntity<>(UpdateClienti, HttpStatus.NO_CONTENT);
        } else {
            clientilogger.error("errore di richiesta id{}", id_cliente);
            throw new ResponseStatusException(HttpStatus.NOT_FOUND, "non è possibile trovare questo  id: " + id_cliente);
        }
    }
    // DELETE
    @DeleteMapping("clienti/{id_cliente}")
    @ResponseStatus(HttpStatus.NO_CONTENT)
    public ResponseEntity<String> DeleteClientiId(@PathVariable Long id){
        if (id == null){
            clientilogger.error("richiesta errore id{}", id);
            throw new ResponseStatusException(HttpStatus.BAD_REQUEST);
        }
        clientilogger.trace("richiesta con successo per id {}", id);
        return new ResponseEntity<>(
                service.DeleteClientiId(id) ? "cliente con id" + id + "è stato elimanto con successo" : "Libro con id" + id + "non è stato eliminato",
                HttpStatus.NO_CONTENT
        );
    }
}

