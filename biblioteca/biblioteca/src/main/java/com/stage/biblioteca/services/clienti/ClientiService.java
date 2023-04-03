package com.stage.biblioteca.services.clienti;

import com.stage.biblioteca.dto.clienti.ClientiDto;
import com.stage.biblioteca.dto.libri.LibriDto;
import com.stage.biblioteca.mapper.clienti.ClientiMapper;
import com.stage.biblioteca.mapper.libri.LibriMapper;
import com.stage.biblioteca.repository.clienti.ClientiRepo;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.ArrayList;
import java.util.List;

@Service
public class ClientiService {
    @Autowired
    ClientiRepo clientirepo;
    //GET
    public List<ClientiDto> findClientiAll(){
        List<ClientiDto> responseFindAll =  new ArrayList<>();
        clientirepo.findAll().forEach(cliente -> {
            responseFindAll.add( ClientiMapper.INSTANCE.todto(cliente));
        });
        return  responseFindAll;
    }

    //GET
    public List<ClientiDto> findClientiByEmail(String email) {
        List<ClientiDto> responseFindByEmail = new ArrayList<>();
        clientirepo.findAll().forEach(cliente -> {
            if (cliente.getEmail().equals(email)) {
                responseFindByEmail.add(ClientiMapper.INSTANCE.todto(cliente));
            }
        });
        return responseFindByEmail;
    }

}
