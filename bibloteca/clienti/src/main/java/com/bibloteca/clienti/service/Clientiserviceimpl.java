package com.bibloteca.clienti.service;
import com.bibloteca.clienti.entity.Clienti;
import com.bibloteca.clienti.repository.Clientirepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.stereotype.Service;
import org.springframework.web.server.ResponseStatusException;

import java.util.ArrayList;
import java.util.List;
@Service
public class Clientiserviceimpl implements  Clientiservice{

    private final List<Clienti> empty = new ArrayList<>();
    private final Clientirepository repo;

    @Autowired

    public Clientiserviceimpl(Clientirepository repo) {
        this.repo = repo;
    }

    @Override
    public Clienti GetId(Long id){
        return repo.findById(id).orElseThrow(()-> new ResponseStatusException(HttpStatus.NOT_FOUND, "nessun cliente trovato con questo id:" + id));
    }

    @Override
    public List<Clienti> GetAllClienti() {
    List<Clienti> clientitutti = repo.findAll();

    if(clientitutti.isEmpty()){
        return empty;
    }
    return clientitutti;
}
    @Override
    public List<Clienti> GetEmail(String email) {

        List<Clienti> clientiemail = repo.FindClientiEmail(email);
        System.out.println(clientiemail);
        if (!clientiemail.isEmpty()) {
            return clientiemail;
        } else {
            throw new ResponseStatusException(HttpStatus.NOT_FOUND, "Nessuna email trovata per questo cliente: " + email);
        }
    }
    @Override
    public Clienti AddClienti(Clienti NewClienti) {
        return repo.save(NewClienti);
    }
    @Override
    public Clienti UpdateClienti(Clienti updatedClienti) {
        return repo.save(updatedClienti);
    }
    @Override
    public boolean DeleteClientiId(Long id) {
        if( !repo.findById(id).isPresent())
            throw new ResponseStatusException(HttpStatus.NOT_FOUND, "Nessun id trovato per il cliente: " + id);
        repo.deleteById(id);
        return repo.findById(id).isEmpty();

    }
    @Override
    public void Update_Clienti(Clienti OldClienti) {
    }
}
