package com.test.biblioteca.service;
import com.test.biblioteca.entity.Clienti;
import com.test.biblioteca.repository.ClientiRepo;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.stereotype.Service;
import org.springframework.web.server.ResponseStatusException;

import java.util.ArrayList;
import java.util.List;
@Service
public class ClientiServiceImpl implements  ClientiService{

    private final List<Clienti> empty = new ArrayList<>();
    private final ClientiRepo repo;

    @Autowired

    public ClientiServiceImpl(ClientiRepo repo) {
        this.repo = repo;
    }

    @Override
    public Clienti getid(Long id){
        return repo.findById(id).orElseThrow(()-> new ResponseStatusException(HttpStatus.NOT_FOUND, "nessun cliente trovato con questo id:" + id));
    }

    @Override
    public List<Clienti> getallclienti() {
        List<Clienti> clientitutti = repo.findAll();

        if(clientitutti.isEmpty()){
            return empty;
        }
        return clientitutti;
    }
    @Override
    public Clienti addclienti(Clienti newclienti) {
        return repo.save(newclienti);
    }
    @Override
    public Clienti updateclienti(Clienti updatedclienti) {
        return repo.save(updatedclienti);
    }
    @Override
    public boolean deleteclienti(Long id) {
        if(!repo.findById(id).isPresent())
            throw new ResponseStatusException(HttpStatus.NOT_FOUND, "Nessun id trovato per il cliente: " + id);
        repo.deleteById(id);
        return repo.findById(id).isEmpty();

    }

}
