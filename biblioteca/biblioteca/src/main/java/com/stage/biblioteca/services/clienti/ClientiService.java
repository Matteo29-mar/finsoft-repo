package com.stage.biblioteca.services.clienti;
import com.stage.biblioteca.dto.clienti.ClientiDto;
import com.stage.biblioteca.entity.clienti.Clienti;
import com.stage.biblioteca.mapper.clienti.ClientiMapper;
import com.stage.biblioteca.repository.clienti.ClientiRepo;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import java.util.ArrayList;
import java.util.List;
import java.util.Optional;
import java.util.concurrent.atomic.AtomicReference;
@Service
public class ClientiService {
    @Autowired
    ClientiRepo clientirepo;
    //GET ALL
    public List<ClientiDto> findClientiAll(){
        List<ClientiDto> responseFindAll =  new ArrayList<>();
        clientirepo.findAll().forEach(cliente -> {
            responseFindAll.add( ClientiMapper.INSTANCE.todto(cliente));
        });
        return  responseFindAll;
    }
    //GET EMAIL
    public ClientiDto findClientiByemail(String email){
    Optional<Clienti> res = clientirepo.findByEmail(email);
    ClientiDto clientiDto = new ClientiDto();
    if(res.isPresent()){
        clientiDto = ClientiMapper.INSTANCE.todto(res.get());
    }
    return clientiDto;
    }
 //GET ID
    //stiamo usando il costrutto findbyid per cercare id senza fare il find all e cercare il singolo id
    public ClientiDto findClientiId(Integer idCliente){
         Optional<Clienti> opt =  clientirepo.findById(idCliente);
         ClientiDto clientiDto = new ClientiDto();
         if(opt.isPresent()){
             clientiDto = ClientiMapper.INSTANCE.todto(opt.get());
         }
        return clientiDto;
    }
    //POST
    public void  createClienti(ClientiDto clientiDto) {
        Clienti clienti = ClientiMapper.INSTANCE.toEntity(clientiDto);
        clientirepo.save(clienti);
    }
    //PUT
    public ClientiDto updateClienti(ClientiDto clientiDto, Integer idCliente){
        AtomicReference<ClientiDto> response = new AtomicReference<>(new ClientiDto());
        clientirepo.findAll().forEach(putcliente ->{
            if(putcliente.getIdCliente().intValue() == idCliente.intValue()){
                putcliente.setNome(clientiDto.getNome());
                putcliente.setCognome(clientiDto.getCognome());
                putcliente.setEmail(clientiDto.getEmail());
                putcliente.setTelefono(clientiDto.getTelefono());
                putcliente.setDataNascita(clientiDto.getDataNascita());
                putcliente = clientirepo.save(putcliente);
                response.set(ClientiMapper.INSTANCE.todto(putcliente));
            }
        });
        return response.get();
    }
    //DELETE
    public void deleteClientiId(Integer idCliente) {
        Optional<Clienti> opt =  clientirepo.findById(idCliente);
        if(opt.isPresent()){
            clientirepo.delete(opt.get());
        } else {
            throw new RuntimeException("risorsa non trovata impossibile cancellare");
        }
    }
}
